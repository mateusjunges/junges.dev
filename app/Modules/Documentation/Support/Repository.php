<?php

namespace App\Modules\Documentation\Support;

use App\Modules\Documentation\Sheets\DocumentationPage;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Repository
{
    public string $slug;

    public Collection $aliases;

    public ?string $category;

    public function __construct(string $slug, Collection $aliases, DocumentationPage $index)
    {
        $this->slug = $slug;
        $this->aliases = $aliases->sortByDesc('slug');
        $this->category = $index->category ?? null;
    }

    public function getAlias(string $alias): ?Alias
    {
        return $this->aliases->firstWhere('slug', $alias);
    }

    public function getStargazersUrl(): string
    {
        return "https://github.com/mateusjunges/".$this->slug."/stargazers";
    }

    public function getForksUrl(): string
    {
        return "https://github.com/mateusjunges/".$this->slug."/network/members";
    }

    public function getSortedAliases(): Collection
    {
        return $this->aliases->sortByDesc(
            fn (Alias $value, string $key) => (int) Str::after($key, 'v1.')
        );
    }
}
