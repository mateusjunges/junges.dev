<?php

use App\Models\User;
use App\Modules\Blog\Models\Post;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders([
        \App\Providers\FlashServiceProvider::class,
        \App\Providers\HorizonServiceProvider::class,
        \App\Providers\TelescopeServiceProvider::class,
        \App\Providers\TwitterServiceProvider::class,
        \App\Providers\ViewServiceProvider::class,
        \App\Providers\BladeComponentServiceProvider::class,
        \App\Providers\HealthServiceProvider::class,
        \App\Providers\ModulesServiceProvider::class,
        \App\Providers\NavigationServiceProvider::class,
    ])
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::bind('postSlug', function ($slug) {
                /** @var Post $post */
                $post = Post::findByIdSlug($slug);

                if (! $post) {
                    abort(404);
                }

                $user = auth()->user();

                if ($user instanceof User && $user->email === 'mateus@junges.dev') {
                    return $post;
                }

                if ($post->preview_secret === request()->get('preview_secret')) {
                    return $post;
                }

                if (! $post->published) {
                    abort(404);
                }

                return $post;
            });
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn () => route('login'));
        $middleware->redirectUsersTo('/');

        $middleware->web(\App\Http\Middleware\CacheControl::class);

        $middleware->throttleApi('60,1');

        $middleware->replace(\Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class, \App\Http\Middleware\PreventRequestsDuringMaintenance::class);
        $middleware->replace(\Illuminate\Foundation\Http\Middleware\TrimStrings::class, \App\Http\Middleware\TrimStrings::class);
        $middleware->replace(\Illuminate\Http\Middleware\TrustProxies::class, \App\Http\Middleware\TrustProxies::class);

        $middleware->replaceInGroup('web', \Illuminate\Cookie\Middleware\EncryptCookies::class, \App\Http\Middleware\EncryptCookies::class);
        $middleware->replaceInGroup('web', \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class, \App\Http\Middleware\VerifyCsrfToken::class);

        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
            'cacheResponse' => \Spatie\ResponseCache\Middlewares\CacheResponse::class,
            'doNotCacheResponse' => \Spatie\ResponseCache\Middlewares\DoNotCacheResponse::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->reportable(function (ValidationException $exception) {
            flash()->error('Please correct the errors in the form');
        });
    })->create();
