<?php

namespace App\Modules\Blog\Http\Controllers\Links;

use App\Modules\Blog\Models\Link;
use Illuminate\Contracts\View\View;

final class IndexController
{
    public function __invoke(): View
    {
        $links = Link::query()
            ->latest()
            ->approved()
            ->simplePaginate(20);

        return view('front.links.index', ['links' => $links]);
    }
}
