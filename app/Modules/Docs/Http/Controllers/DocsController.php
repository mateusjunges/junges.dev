<?php

declare(strict_types=1);

namespace App\Modules\Docs\Http\Controllers;

use App\Modules\Docs\Models\Repository;
use App\Modules\Docs\Sheets\DocumentationPage;
use App\Modules\Docs\Support\Docs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\View\View;

final class DocsController
{
    public function index(Docs $docs): View
    {
        $githubRepositories = Repository::all();

        return view('front.docs.index', [
            'repositories' => $docs->getRepositories(),
            'githubRepositories' => $githubRepositories,
        ]);
    }

    public function repository(Docs $docs, string $repository, ?string $alias = null): View|RedirectResponse
    {
        try {
            $repository = $docs->getRepository($repository);
        } catch (\RuntimeException) {
            abort(404, 'Repository not found');
        }

        abort_if(is_null($repository), 404, 'Repository not found');

        if ($alias) {
            preg_match('/v\d+/', $alias, $matches);

            if (! count($matches)) {
                $latest = $repository->aliases->keys()->first();
                $slug = $alias;
                $alias = $latest;

                return redirect()->action([DocsController::class, 'show'], [$repository->slug, $alias, $slug]);
            }

            $alias = $repository->getAlias($alias);

            abort_if(is_null($alias), 404, 'Alias not found');
        } else {
            $alias = $repository->getSortedAliases()->first();
        }

        return redirect()->action([DocsController::class, 'show'], [
            $repository->slug,
            $alias->slug,
            $alias->pages->where('section', '_root')->first()->slug,
        ]);
    }

    public function show(string $repository, string $alias, string $slug, Docs $docs): View|RedirectResponse
    {
        try {
            $repository = $docs->getRepository($repository);
        } catch (\RuntimeException) {
            abort(404, 'Repository not found');
        }

        preg_match('/v\d+/', $alias, $matches);

        if (! count($matches)) {
            $latest = $repository->aliases->keys()->first();
            $slug = "{$alias}/{$slug}";
            $alias = $latest;

            return redirect()->action([DocsController::class, 'show'], [$repository->slug, $alias, $slug]);
        }

        abort_if(is_null($repository), 404, 'Repository not found');

        $alias = $repository->getAlias($alias);

        if ($alias === null) {
            $alias = $repository->aliases->keys()->first();

            return redirect()->action([DocsController::class, 'show'], [$repository->slug, $alias, $slug]);
        }

        $pages = $alias->pages;

        $page = $pages->firstWhere('slug', $slug);

        if (! $page) {
            return redirect()->action([DocsController::class, 'repository'], [$repository->slug, $alias->slug]);
        }

        $repositories = $docs->getRepositories();

        $navigation = $this->getNavigation($pages);

        $showBigTitle = $page->slug === $navigation['_root']['pages'][0]->slug;

        $tableOfContents = $this->extractTableOfContents($page->contents);

        $content = str_replace('[[announcement-placeholder]]', Blade::render('<x-pairing-session-announcement/>'), $page->contents);

        return view('front.docs.show', [
            'page' => $page,
            'content' => $content,
            'repositories' => $repositories,
            'repository' => $repository,
            'pages' => $pages,
            'navigation' => $navigation,
            'alias' => $alias,
            'showBigTitle' => $showBigTitle,
            'tableOfContents' => $tableOfContents,
        ]);
    }

    private function getNavigation(Collection $pages): Collection
    {
        $navigation = $pages
            ->reduce(function (array $navigation, DocumentationPage $page) {
                if ($page->isIndex()) {
                    $navigation[$page->section]['_index'] = $page;
                } else {
                    $navigation[$page->section]['pages'][] = $page;
                }

                return $navigation;
            }, []);

        return collect($navigation)->sortBy(fn (array $pages) => $pages['_index']->weight ?? -1);
    }

    private function extractTableOfContents(HtmlString|string $contents): array
    {
        $h2 = [];

        $contents = (string) $contents;

        preg_match_all('/<h2.*><a.*id="([^"]+)".*>#<\/a>([^<]+)/', $contents, $h2);

        $h3 = [];

        preg_match_all('/<h3.*><a.*id="([^"]+)".*>#<\/a>([^<]+)/', $contents, $h3);

        $matches = $h2 + $h3;

        return array_combine($matches[1], $matches[2]);
    }
}
