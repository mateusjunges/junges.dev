<?php

namespace App\Providers;

use App\Modules\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
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
    }

    public function register(): void
    {
        $this->app->register(\App\Providers\TwitterServiceProvider::class);
        $this->app->register(\App\Providers\ViewServiceProvider::class);
        $this->app->register(\App\Providers\BladeComponentServiceProvider::class);
        $this->app->register(\App\Providers\HealthServiceProvider::class);
        $this->app->register(\App\Providers\CashierServiceProvider::class);
    }
}
