<?php

namespace App\Models;

use App\Modules\Posts\Models\Post;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

final class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
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
        return in_array($this->email, [
                'mateus@junges.dev',
                'mateusf.junges@gmail.com'
            ])
            || (
                str_ends_with($this->email, '@junges.dev') && $this->hasVerifiedEmail()
            );
    }
}
