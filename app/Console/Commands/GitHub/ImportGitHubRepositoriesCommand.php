<?php

namespace App\Console\Commands\GitHub;

use App\Models\Repository;
use App\Services\GitHub\GitHubApi;
use Carbon\Carbon;
use DateTime;
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

            $repository = Repository::updateOrCreate(['name' => $repositoryAttributes['name'] ?? null], [
                'name' => $repositoryAttributes['name'],
                'description' => $repositoryAttributes['description'],
                'stars' => $repositoryAttributes['stargazers_count'],
                'language' => $repositoryAttributes['language'],
                'repository_created_at' => Carbon::createFromFormat(DateTime::ATOM, $repositoryAttributes['created_at']),
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
