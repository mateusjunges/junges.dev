<?php declare(strict_types=1);

namespace App\Modules\Docs\Actions;

use App\Modules\Docs\Models\Repository;

final class UpdateRepositoriesDocumentationUrl
{
    public function __invoke(): void
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
