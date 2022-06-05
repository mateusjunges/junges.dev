<?php

namespace App\Console;

use App\Console\Commands\GitHub\ImportDocsFromRepositoriesCommand;
use App\Console\Commands\Packagist\ImportPackagistDownloadsCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(ImportPackagistDownloadsCommand::class)->hourly();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
