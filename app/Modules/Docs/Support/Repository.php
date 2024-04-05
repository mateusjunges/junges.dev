<?php

declare(strict_types=1);

namespace App\Modules\Docs\Support;

use App\Modules\Docs\Sheets\DocumentationPage;
use Illuminate\Support\Collection;

final class Repository
{
    public string $slug;

    public Collection $aliases;

    public function __construct(string $slug, Collection $aliases)
    {
        $this->slug = $slug;
        $this->aliases = $aliases->sortByDesc('slug');
    }

    public function getAlias(string $alias): ?Alias
    {
        return $this->aliases->firstWhere('slug', $alias);
    }

    public function getStargazersUrl(): string
    {
        return 'https://github.com/mateusjunges/'.$this->slug.'/stargazers';
    }

    public function getForksUrl(): string
    {
        return 'https://github.com/mateusjunges/'.$this->slug.'/network/members';
    }

    public function getSortedAliases(): Collection
    {
        $repository = collect(config('docs.repositories'))
            ->where('name', $this->slug)
            ->first();

        return $this->aliases->sortByDesc(static fn (Alias $value, string $key) => $key)->filter(
            fn (Alias $alias) => in_array($alias->slug, $repository['branches'])
        );
    }
}
