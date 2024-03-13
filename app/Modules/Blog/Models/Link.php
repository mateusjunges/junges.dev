<?php

namespace App\Modules\Blog\Models;

use App\Concerns\HasSlug;
use App\Contracts\Sluggable;
use App\Modules\Auth\Models\User;
use App\Modules\Blog\QueryBuilders\LinkEloquentBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\URL;
use Tests\Factories\LinkFactory;

/**
 * @property int $id The model identifier.
 * @property int $user_id The user identifier.
 * @property bool $approved Whether the link has been approved.
 * @property string $title The link title.
 * @property string $url The link URL.
 * @property string $text The link text.
 * @property string $status The link status.
 * @property string $slug The link slug.
 * @property-read string $host_url The link host URL.
 * @property \Illuminate\Support\Carbon $publish_date The link publish date.
 * @property \Illuminate\Support\Carbon $created_at The date and time the link was created.
 * @property \Illuminate\Support\Carbon $updated_at The date and time the link was last updated.
 */
final class Link extends Model implements Sluggable
{
    use HasFactory;
    use HasSlug;

    protected $table = 'blog__links';

    public const STATUS_SUBMITTED = 'pending';

    public const STATUS_APPROVED = 'approved';

    public const STATUS_REJECTED = 'rejected';

    /** {@inheritDoc} */
    protected function casts(): array
    {
        return [
            'publish_date' => 'datetime',
        ];
    }

    public static function query(): LinkEloquentBuilder
    {
        $builder = parent::query();
        assert($builder instanceof LinkEloquentBuilder);

        return $builder;
    }

    /** {@inheritDoc} */
    public function newEloquentBuilder($query): LinkEloquentBuilder
    {
        return new LinkEloquentBuilder($query);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getSluggableValue(): string
    {
        return $this->title;
    }

    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function hostUrl(): Attribute
    {
        return new Attribute(
            get: fn () => parse_url($this->url)['host'] ?? null,
        );
    }

    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function approveUrl(): string
    {
        return URL::temporarySignedRoute(
            'link.approve',
            now()->addMonth(),
            ['link' => $this],
        );
    }

    public function approveAndCreatePostUrl(): string
    {
        return URL::temporarySignedRoute(
            'link.approve-and-create-post',
            now()->addMonth(),
            ['link' => $this],
        );
    }

    public function rejectUrl(): string
    {
        return URL::temporarySignedRoute(
            'link.reject',
            now()->addMonth(),
            ['link' => $this],
        );
    }

    public static function newFactory(): LinkFactory
    {
        return new LinkFactory();
    }
}
