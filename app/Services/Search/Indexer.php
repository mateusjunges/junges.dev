<?php

namespace App\Services\Search;

use Spatie\SiteSearch\Indexers\DefaultIndexer;

class Indexer extends DefaultIndexer
{
    public function pageTitle(): ?string
    {
        return str_replace(
            " - Mateus Junges's blog on PHP and Laravel",
            '',
            parent::pageTitle()
        );
    }
}
