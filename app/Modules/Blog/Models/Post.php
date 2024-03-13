<?php

declare(strict_types=1);

namespace App\Modules\Blog\Models;

use App\Concerns\HasSlug;
use App\Contracts\Sluggable;
use App\Modules\Auth\Models\User;
use App\Modules\Blog\Actions\ConvertPostTextToHtmlAction;
use App\Modules\Blog\Actions\PublishPostAction;
use App\Modules\Blog\Jobs\CreateOgImageJob;
use App\Modules\Blog\Models\Presenters\PostPresenter;
use App\Modules\Blog\QueryBuilders\PostEloquentBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Str;
use Spatie\Comments\Models\Concerns\HasComments;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ResponseCache\Facades\ResponseCache;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;
use Tests\Factories\PostDbFactory;

/**
 * @property int $id The post identifier.
 * @property int $submitted_by_user_id The user identifier who submitted the post.
 * @property string $author The post author.
 * @property string $external_url The external URL for this post.
 * @property string $tweet_url The tweet URL for this post.
 * @property bool $send_automated_tweet Whether to send an automated tweet for this post.
 * @property string $author_twitter_handle The author's Twitter handle.
 * @property string $text The post content.
 * @property bool $original_content Whether the post is original content.
 * @property string $preview_secret The preview secret.
 * @property string $type The post type.
 * @property string $html The post content in HTML format.
 * @property string $title The post title.
 * @property bool $published Whether the post is published.
 * @property \Illuminate\Support\Carbon $published_at The date and time when the post was published.
 * @property \Illuminate\Support\Carbon $publish_date The date and time when the post should be published.
 * @property bool $tweet_sent Whether the tweet was sent.
 * @property string $slug The post slug.
 * @property-read $promotional_url The promotional URL for this post.
 * @property \Illuminate\Support\Carbon $created_at The date and time when the post was created.
 * @property \Illuminate\Support\Carbon $updated_at The date and time when the post was updated.
 * @property
 */
final class Post extends Model implements HasMedia, Sluggable
{
    public const TYPE_LINK = 'link';

    public const TYPE_TWEET = 'tweet';

    public const TYPE_ORIGINAL = 'originalPost';

    use HasComments,
        HasFactory,
        HasSlug,
        HasTags,
        InteractsWithMedia,
        PostPresenter;

    /** @var string */
    protected $table = 'blog__posts';

    public $with = ['tags'];

    public $dates = ['publish_date'];

    public $casts = [
        'published' => 'boolean',
        'original_content' => 'boolean',
        'send_automated_tweet' => 'boolean',
        'toot_sent' => 'boolean',
    ];

    protected static function booted()
    {
        self::creating(function (Post $post) {
            $post->preview_secret = Str::random(10);
        });

        self::saved(function (Post $post) {
            self::withoutEvents(function () use ($post) {
                (new ConvertPostTextToHtmlAction())->execute($post);

                if ($post->isPartOfSeries()) {
                    $post->getAllPostsInSeries()->each(function (Post $post) {
                        (new ConvertPostTextToHtmlAction())->execute($post);
                    });
                }
            });

            if ($post->published) {
                self::withoutEvents(function () use ($post) {
                    (new PublishPostAction())->execute($post);
                });

                return;
            }

            Bus::chain([
                new CreateOgImageJob($post),
                fn () => ResponseCache::clear(),
            ])->dispatch();
        });
    }

    public static function query(): PostEloquentBuilder
    {
        $builder = parent::query();
        assert($builder instanceof PostEloquentBuilder);

        return $builder;
    }

    /** {@inheritDoc} */
    public function newEloquentBuilder($query): PostEloquentBuilder
    {
        return new PostEloquentBuilder($query);
    }

    public function submittedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by_user_id');
    }

    public function updateAttributes(array $attributes): self
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

    public function url(): Attribute
    {
        return new Attribute(
            get: fn () => route('post', [$this->idSlug()])
        );
    }

    public function previewUrl(): Attribute
    {
        return new Attribute(function () {
            return route('post', [$this->idSlug()])."?preview_secret={$this->preview_secret}";
        });
    }

    public function adminPreviewUrl(): string
    {
        return $this->published ? $this->url : $this->preview_url;
    }

    public function promotionalUrl(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->external_url !== null && $this->external_url !== '') {
                    return $this->external_url;
                }

                return $this->url;
            }
        );
    }

    public function hasTag(string $tagName): bool
    {
        return $this->refresh()
            ->tags
            ->contains(fn (Tag $tag) => $tag->name === $tagName);
    }

    public function isLink(): bool
    {
        return $this->getType() === self::TYPE_LINK;
    }

    public function isTweet(): bool
    {
        return $this->getType() === self::TYPE_TWEET;
    }

    public function isOriginal(): bool
    {
        return $this->getType() === self::TYPE_ORIGINAL;
    }

    public function getType(): string
    {
        if ($this->hasTag('tweet')) {
            return self::TYPE_TWEET;
        }

        if ($this->original_content) {
            return self::TYPE_ORIGINAL;
        }

        return self::TYPE_LINK;
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('ogImage')
            ->useDisk('og-images')
            ->singleFile();
    }

    public function getSluggableValue(): string
    {
        return $this->title;
    }

    public function toTweet(): string
    {
        $tags = $this->tags
            ->map(fn (Tag $tag) => $tag->name)
            ->map(fn (string $tagName) => '#'.str_replace(' ', '', $tagName))
            ->implode(' ');

        $twitterAuthorString = '';
        if ($twitterHandle = $this->authorTwitterHandle()) {
            $twitterAuthorString = " (by @{$twitterHandle})";
        }

        return $this->relatedEmoji().' '.$this->title.$twitterAuthorString
            .PHP_EOL.$this->promotional_url
            .PHP_EOL.$tags;
    }

    public function onAfterTweet(string $tweetUrl): void
    {
        $this->tweet_url = $tweetUrl;

        $this->save();
    }

    public function ogImageBaseUrl(): string
    {
        if ($this->external_url !== '' && $this->external_url !== null) {
            return $this->external_url;
        }

        return route('post.ogImage', $this)."?preview_secret={$this->preview_secret}";
    }

    public function isPartOfSeries(): bool
    {
        return ! empty($this->series_slug);
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
        if ($this->author_twitter_handle !== '' && $this->author_twitter_handle !== null) {
            return $this->author_twitter_handle;
        }

        if ($userTwitterHandle = $this->submittedByUser?->twitter_handle) {
            return $userTwitterHandle;
        }

        return null;
    }

    public function commentableName(): string
    {
        return $this->title;
    }

    public function commentUrl(): string
    {
        return $this->url;
    }

    public static function newFactory(): PostDbFactory
    {
        return new PostDbFactory();
    }
}
