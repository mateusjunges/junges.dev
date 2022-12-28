<?php

namespace App\Console;

use App\Modules\Blog\Console\Commands\PublishScheduledPostsCommand;
use App\Modules\Docs\Console\Commands\GitHub\ImportDocsFromRepositoriesCommand;
use App\Modules\Docs\Console\Commands\Packagist\ImportPackagistDownloadsCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Spatie\Health\Commands\RunHealthChecksCommand;
use Spatie\ScheduleMonitor\Models\MonitoredScheduledTaskLogItem;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(ImportPackagistDownloadsCommand::class)->everyFifteenMinutes();
        $schedule->command(ImportDocsFromRepositoriesCommand::class)->everyMinute();
        $schedule->command(RunHealthChecksCommand::class)->everyMinute();
        $schedule->command(PublishScheduledPostsCommand::class)->everyMinute();
        $schedule->command('responsecache:clear')->daily();
        $schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run')->dailyAt('3:00');
        $schedule->command('site-search:crawl')->daily();
        $schedule->command('model:prune', ['--model' => MonitoredScheduledTaskLogItem::class])->daily();
    }

    protected function commands()
    {
        $this->load([
            __DIR__.'/Commands',
            app_path('Modules/Blog/Console/Commands'),
            app_path('Modules/Docs/Console/Commands'),
        ]);
    }
}
