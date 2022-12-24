<?php

namespace App\Console;

use App\Modules\Documentation\Console\Commands\GitHub\ImportDocsFromRepositoriesCommand;
use App\Modules\Documentation\Console\Commands\Packagist\ImportPackagistDownloadsCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(ImportPackagistDownloadsCommand::class)->everyFifteenMinutes();
        $schedule->command(ImportDocsFromRepositoriesCommand::class)->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
