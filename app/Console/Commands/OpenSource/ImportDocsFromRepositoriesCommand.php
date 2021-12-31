<?php

namespace App\Console\Commands\OpenSource;

use App\Support\ValueStores\UpdatedRepositoriesValueStore;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use React\ChildProcess\Process;
use React\EventLoop\Loop;
use React\EventLoop\LoopInterface;
use Spatie\Sheets\Sheets;
use function React\Promise\all;
use function WyriHaximus\React\childProcessPromise;

class ImportDocsFromRepositoriesCommand extends Command
{
    protected $signature = 'docs:import';

    protected $description = 'Fetches docs from all repositories in docs-repositories.json';

    public function handle(): int
    {
        $this->info('Importing docs...');

        $loop = Loop::get();

        $updatedRepositoriesValueStore = UpdatedRepositoriesValueStore::make();

        $updatedRepositoriesNames = $updatedRepositoriesValueStore->getNames();

        $this->convertRepositoriesToProcesses($updatedRepositoriesNames, $loop)
            ->pipe(fn (Collection $processes) => $this->wrapInPromise($processes));

        $loop->run();

        $updatedRepositoriesValueStore->flush();

        $this->info('All done!');

        return Command::SUCCESS;
    }

    protected function convertRepositoriesToProcesses(
        array $updatedRepositoryNames,
        LoopInterface $loop
    ): Collection {
        $repositoriesWithDocs = $this->getRepositoriesWitDocs();

        return collect($updatedRepositoryNames)
            ->map(fn (string $repositoryName) => $repositoriesWithDocs[$repositoryName] ?? null)
            ->filter()
            ->flatMap(function (array $repository) {
                return collect($repository['branches'])
                    ->map(fn (string $alias, string $branch) => [$repository, $alias, $branch])
                    ->toArray();
            })
            ->mapSpread(function (array $repository, string $alias, string $branch) use ($loop) {
                $process = $this->createProcessComponent($repository, $branch, $alias);

                return childProcessPromise($loop, $process);
            });
    }

    protected function wrapInPromise(Collection $processes): void
    {
        all($processes->toArray())
            ->then(function (): void {
                $this->info('Fetched docs from all repositories.');

                $this->info('Caching Sheets.');

                $pages = app(Sheets::class)->collection('docs')->all()->sortBy('weight');

                cache()->store('docs')->forever('docs', $pages);

                $this->info('Done caching Sheets.');
            })
            ->always(function (): void {
                File::deleteDirectory(storage_path('docs-temp/'));
            });
    }

    protected function getRepositoriesWitDocs(): Collection
    {
        return collect(config('docs.repositories'))->keyBy('repository');
    }

    protected function createProcessComponent(array $repository, string $branch, string $alias): Process
    {
        $accessToken = config('services.github.docs_access_token');
        $publicDocsAssetPath = public_path('docs');

        return new Process(
            <<<BASH
                    rm -rf storage/docs/{$repository['name']}/{$alias} \
                    && mkdir -p storage/docs/{$repository['name']}/{$alias} \
                    && mkdir -p storage/docs-temp/{$repository['name']}/{$alias} \
                    && cd storage/docs-temp/{$repository['name']}/{$alias} \
                    && git init \
                    && git config core.sparseCheckout true \
                    && echo "/docs" >> .git/info/sparse-checkout \
                    && git remote add -f origin https://{$accessToken}@github.com/mateusjunges/{$repository['name']}.git \
                    && git pull origin ${branch} \
                    && cp -r docs/* ../../../docs/{$repository['name']}/{$alias} \
                    && echo "---\ntitle: {$repository['name']}\ncategory: {$repository['category']}\n---" > ../../../docs/{$repository['name']}/_index.md \
                    && cd docs/ \
                    && find . -not -name '*.md' | cpio -pdm {$publicDocsAssetPath}/{$repository['name']}/{$alias}/
                BASH
        );
    }
}
