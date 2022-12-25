<?php

namespace App\Modules\Posts\Models;

use App\Jobs\CreateOgImageJob;
use App\Models\Concerns\HasSlug;
use App\Models\User;
use App\Modules\Blog\Actions\ConvertPostToHtmlAction;
use App\Modules\Blog\Actions\PublishPostAction;
use App\Modules\Posts\Contracts\Sluggable;
use App\Modules\Posts\Presenters\PostPresenter;
use App\Modules\Posts\QueryBuilders\PostsEloquentBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Spatie\Comments\Models\Concerns\HasComments;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;
use Tests\Factories\PostDatabaseFactory;

/**
 * @property string $promotional_url
 * @property \Illuminate\Support\Carbon $publish_date
 * @property bool $published
 * @property boolean $original_content
 * @property ?string $external_url
 * @property string $title
 * @property string $html
 * @property string $text
 * @property ?string $preview_secret
 * @property ?string $emoji
 * @property string $tweet_url
 * @property mixed $author_twitter_handle
 * @property \App\Models\User $submittedByUser
 * @property boolean $send_automated_tweet
 * @property boolean $tweet_sent
 * @property string $series_slug
 * @property int $id
 */
class Post extends Model implements Sluggable, HasMedia
{
    use HasFactory;
    use HasSlug;
    use PostPresenter;
    use HasTags;
    use InteractsWithMedia;
    use HasComments;

    public const TYPE_LINK = 'link';
    public const TYPE_TWEET = 'tweet';
    public const TYPE_ORIGINAL = 'original';

    protected $dates = ['publish_date'];

    public $casts = [
        'published' => 'boolean',
        'original_content' => 'boolean',
        'send_automate_tweet' => 'boolean',
    ];

    public static function booted()
    {
        static::creating(function (Post $post) {
            $post->preview_secret = Str::random(10);
        });


        static::saved(function (Post $post) {
            static::withoutEvents(function () use ($post) {
                (new ConvertPostToHtmlAction())->execute($post);

                if ($post->isPartOfSeries()) {
                    $post->getAllPostsInSeries()->each(function(Post $post) {
                        (new ConvertPostToHtmlAction())->execute($post);
                    });
                }
            });

            if ($post->published) {
                static::withoutEvents(function () use ($post) {
                    (new PublishPostAction())->execute($post);
                });

                return;
            }

            dispatch(new CreateOgImageJob($post));
        });
    }

    /**
     * @inheritDoc
     * @return PostsEloquentBuilder<self>
     */
    public static function query(): PostsEloquentBuilder
    {
        $builder = parent::query();
        assert($builder instanceof PostsEloquentBuilder);

        return $builder;
    }

    /**
     * @inheritDoc
     * @param \Illuminate\Database\Query\Builder $query
     * @return PostsEloquentBuilder<self>
     */
    public function newEloquentBuilder($query): PostsEloquentBuilder
    {
        return new PostsEloquentBuilder($query);
    }

    public function submittedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by_user_id');
    }

    public function scopeScheduled(Builder $query)
    {
        $query
            ->where('published', false)
            ->whereNotNull('publish_date');
    }

    public function getHtmlWithExternalUrlAttribute(): string
    {
        $html = $this->html;

        if (! $this->isTweet() && $this->external_url) {
            $html .= PHP_EOL . PHP_EOL . "<a href='{$this->external_url}'>Read more</a>";
        }

        return $html;
    }

    public function updateAttributes(array $attributes): Post
    {
        $this->title = $attributes['title'];
        $this->text = $attributes['text'];
        $this->publish_date = $attributes['publish_date'];
        $this->published = $attributes['published'] ?? false;
        $this->original_content = $attributes['original_content'] ?? false;
        $this->external_url = $attributes['external_url'];

        $this->save();

        $tags = explode(',', $attributes['tags_text']);

        $tags = array_map(fn (string $tag) => trim(strtolower($tag)), $tags);

        $this->syncTags($tags);

        return $this;
    }

    public function getUrlAttribute(): string
    {
        return route('posts.show', [$this->slug]);
    }

    public function getPreviewUrlAttribute(): string
    {
        return route('posts.show', [$this->idSlug()]) . "?preview_secret={$this->preview_secret}";
    }

    public function hasTag(string $tagName): bool
    {
        return $this->refresh()
            ->tags
            ->contains(fn (Tag $tag) => $tag->name === $tagName);
    }

    public function isLink(): bool
    {
        return $this->getType() === static::TYPE_LINK;
    }

    public function isTweet(): bool
    {
        return $this->getType() === static::TYPE_TWEET;
    }

    public function isOriginal(): bool
    {
        return $this->getType() === static::TYPE_ORIGINAL;
    }

    public function getType(): string
    {
        if ($this->original_content) {
            return static::TYPE_ORIGINAL;
        }

        return static::TYPE_LINK;
    }

    public function toTweet(): string
    {
        $tags = $this->tags
            ->map(fn (Tag $tag) => $tag->name)
            ->map(fn (string $tagName) => '#' . str_replace(' ', '', $tagName))
            ->implode(' ');

        $twitterAuthorString = '';
        if ($twitterHandle = $this->authorTwitterHandle()) {
            $twitterAuthorString = " (by @{$twitterHandle})";
        }

        return $this->emoji . ' ' . $this->title . $twitterAuthorString
            . PHP_EOL . $this->promotional_url
            . PHP_EOL . $tags;
    }

    public function onAfterTweet(string $tweetUrl): void
    {
        $this->tweet_url = $tweetUrl;

        $this->save();
    }

    public function ogImageBaseUrl(): string
    {
        if ($this->external_url) {
            return $this->external_url;
        }

        return route('post.ogImage', $this) . "?preview_secret={$this->preview_secret}";
    }

    public function isPartOfSeries(): bool
    {
        return $this->series_slug !== null;
    }

    public function getAllPostsInSeries(): Collection
    {
        if (! $this->isPartOfSeries()) {
            return collect();
        }

        return Post::query()
            ->where('series_slug', $this->series_slug)
            ->orderBy('id')
            ->get();
    }

    public function authorTwitterHandle(): ?string
    {
        if ($this->author_twitter_handle) {
            return $this->author_twitter_handle;
        }

        if ($userTwitterHandle = optional($this->submittedByUser)->twitter_handle) {
            return $userTwitterHandle;
        }

        return null;
    }

    public function getSluggableValue(): string
    {
        return $this->title;
    }

    public static function newFactory(): PostDatabaseFactory
    {
        return new PostDatabaseFactory();
    }

    public function commentableName(): string
    {
        return $this->title;
    }

    public function commentUrl(): string
    {
        return $this->url;
    }
}
