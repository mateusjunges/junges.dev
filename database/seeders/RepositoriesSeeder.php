<?php

namespace Database\Seeders;

use App\Console\Commands\GitHub\ImportGitHubRepositoriesCommand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class RepositoriesSeeder extends Seeder
{
    public function run(): void
    {
        Artisan::call(ImportGitHubRepositoriesCommand::class);
    }
}