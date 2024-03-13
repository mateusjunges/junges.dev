<?php

namespace App\Providers;

use App\Modules\Auth\Models\User;
use Exception;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Comments\Models\Comment;
use Spatie\Comments\Notifications\PendingCommentNotification;

final class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::define('viewHorizon', function (User $user) {
            return $user->admin;
        });

        Model::unguard();

        PendingCommentNotification::sendTo(function (Comment $comment) {
            return User::query()->where('email', 'mateus@junges.dev')->first();
        });

        try {
            Filament::registerTheme(
                app(Vite::class)('resources/css/filament.css'),
            );
        } catch (Exception) {
        }
    }
}
