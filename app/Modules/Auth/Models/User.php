<?php

namespace App\Modules\Auth\Models;

use App\Modules\Blog\Models\Link;
use App\Modules\Blog\Models\Post;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Comments\Models\Concerns\InteractsWithComments;
use Spatie\Comments\Models\Concerns\Interfaces\CanComment;
use Tests\Factories\UserFactory;

/**
 * @property int $id The model identifier
 * @property string $name The user's name
 * @property string $twitter_handle The user's Twitter handle
 * @property string $email The user's email address
 * @property bool $admin Whether the user is an administrator
 * @property string $password The user's password
 * @property \Illuminate\Support\Carbon $email_verified_at The date and time the user's email address was verified
 * @property string $remember_token The user's remember token
 * @Property \Illuminate\Support\Carbon $created_at The date and time the model was created
 * @property \Illuminate\Support\Carbon $updated_at The date and time the model was updated
 */
class User extends Authenticatable implements CanComment, MustVerifyEmail, FilamentUser
{
    use HasFactory;
    use InteractsWithComments;
    use Notifiable;

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'admin' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function submittedPosts(): HasMany
    {
        return $this->hasMany(Post::class, 'submitted_by_user_id');
    }

    public function canAccessFilament(): bool
    {
        return $this->email === 'mateus@junges.dev';
    }

    public static function newFactory(): UserFactory
    {
        return new UserFactory();
    }
}
