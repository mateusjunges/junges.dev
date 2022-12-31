<?php declare(strict_types=1);

namespace App\Modules\Docs\Support;

use App\Modules\Docs\Sheets\DocumentationPage;
use Exception;
use Illuminate\Support\Collection;
use Spatie\Sheets\Sheets;

final class Docs
{
    public function getRepository(string $slug): ?Repository
    {
        $pages = cache()->store('docs')->rememberForever(
            $slug,
            fn () => app(Sheets::class)->collection($slug)->all()->sortBy('weight')
        );

        $aliases = $pages
            ->whereNotNull('alias')
            ->groupBy(fn (DocumentationPage $page) => $page->alias)
            ->map(function (Collection $pages) use ($slug) {
                $index = $pages->firstWhere('slug', '_index');
                $pages = $pages
                    ->where('slug', '<>', '_index')
                    ->sortBy(fn (DocumentationPage $page): int => $page->weight ?? PHP_INT_MAX)
                    ->map(function (DocumentationPage $page) use ($slug): DocumentationPage {
                        $page->repository = $slug;
                        return $page;
                    });

                return new Alias($index->title, $index->slogan, $index->branch, $index->githubUrl, $pages);
            })
            ->sortBy('slug');

        $index = $pages
            ->whereNull('alias')
            ->firstWhere('slug', '_index');

        return new Repository($slug, $aliases, $index);
    }

    public function getRepositories(): Collection
    {
        return collect(config('docs.repositories'))
            ->pluck('name')
            ->map(function (string $repositoryName) {
                try {
                    return $this->getRepository($repositoryName);
                } catch (Exception $exception) {
                    report("Error while loading {$repositoryName} docs: " . $exception->getMessage());
                    return null;
                }
            })->filter();
    }
}
