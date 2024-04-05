<?php

use App\Models\User;
use App\Modules\Blog\Console\Commands\PublishScheduledPostsCommand;
use App\Modules\Blog\Models\Post;
use App\Modules\Docs\Console\Commands\GitHub\ImportDocsFromRepositoriesCommand;
use App\Modules\Docs\Console\Commands\Packagist\ImportPackagistDownloadsCommand;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Spatie\Health\Commands\RunHealthChecksCommand;
use Spatie\ScheduleMonitor\Models\MonitoredScheduledTaskLogItem;

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

        $middleware->replace(\Illuminate\Http\Middleware\TrustProxies::class, \App\Http\Middleware\TrustProxies::class);

        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
            'cacheResponse' => \Spatie\ResponseCache\Middlewares\CacheResponse::class,
            'doNotCacheResponse' => \Spatie\ResponseCache\Middlewares\DoNotCacheResponse::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'webhook-webmentions',
            'mailgun-feedback',
        ]);
    })
    ->withCommands([
        app_path('Modules/Blog/Console/Commands'),
        app_path('Modules/Docs/Console/Commands'),
    ])
    ->withSchedule(function (\Illuminate\Console\Scheduling\Schedule $schedule) {
        $schedule->call(ImportPackagistDownloadsCommand::class)->everyFifteenMinutes();
        $schedule->call(ImportDocsFromRepositoriesCommand::class)->everyMinute();
        $schedule->call(RunHealthChecksCommand::class)->everyMinute();
        $schedule->call(PublishScheduledPostsCommand::class)->everyMinute();
        $schedule->call('responsecache:clear')->daily();
        $schedule->call('backup:clean')->daily()->at('01:00');
        $schedule->call('backup:run')->dailyAt('3:00');
        $schedule->call('site-search:crawl')->daily();
        $schedule->call('model:prune', ['--model' => MonitoredScheduledTaskLogItem::class])->daily();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->reportable(function (ValidationException $exception) {
            flash()->error('Please correct the errors in the form');
        });
    })->create();
