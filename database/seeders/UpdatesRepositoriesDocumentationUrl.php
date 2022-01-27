<?php

namespace Database\Seeders;

use App\Models\Repository;
use Illuminate\Database\Seeder;

class UpdatesRepositoriesDocumentationUrl extends Seeder
{
    public function run()
    {
        $repositories = [
            'laravel-kafka',
            'laravel-acl',
            'laravel-2fa',
            'laravel-invite-codes',
            'laravel-pix',
            'laravel-time-helpers',
            'trackable-jobs-for-laravel'
        ];

        collect($repositories)->each(function (string $repository) {
            Repository::query()->where('name', $repository)->update([
                'documentation_url' => "/documentation/$repository"
            ]);
        });
    }
}
