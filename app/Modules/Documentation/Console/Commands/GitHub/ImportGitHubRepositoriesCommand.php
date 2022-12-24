<?php

namespace App\Modules\Documentation\Console\Commands\GitHub;

use App\Modules\Documentation\Models\Repository;
use App\Services\GitHub\GitHubApi;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ImportGitHubRepositoriesCommand extends Command
{
    protected $signature = 'import:github-repositories';

    protected $description = 'Import public repositories from GitHub';

    public function handle(GitHubApi $api): void
    {
        $this->info('Syncing all public repositories...');

        $repositories = $api->fetchPublicRepositories(config('services.github.username'));

        $repositories->each(function (array $repositoryAttributes) use ($api): void {
            $this->comment("Importing `{$repositoryAttributes['name']}`... ");

            /** @var Repository $repository */
            $repository = Repository::query()->updateOrCreate(['name' => $repositoryAttributes['name'] ?? null], [
                'name' => $repositoryAttributes['name'],
                'description' => $repositoryAttributes['description'],
                'stars' => $repositoryAttributes['stargazers_count'],
                'language' => $repositoryAttributes['language'],
                'repository_created_at' => Carbon::createFromFormat(DateTimeInterface::ATOM, $repositoryAttributes['created_at']),
                'forks' => $repositoryAttributes['forks']
            ]);

            $repository->setTopics(
                Cache::remember(
                    "repository_topics-{$repository->name}",
                    3600,
                    fn () => $api->fetchRepositoryTopics(config('services.github.username'), $repository->name)
                )
            );
        });

        $this->info('All done!');
    }
}
