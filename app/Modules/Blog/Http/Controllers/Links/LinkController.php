<?php

namespace App\Modules\Blog\Http\Controllers\Links;

use App\Modules\Blog\Actions\CreateLinkAction;
use App\Modules\Blog\Http\Requests\CreateLinkRequest;
use Spatie\RouteDiscovery\Attributes\Route;

#[Route(middleware: ['auth', 'verified', 'doNotCacheResponse'])]
class LinkController
{
    public function create()
    {
        return view('front.links.create');
    }

    public function store(CreateLinkRequest $request, CreateLinkAction $createLinkAction)
    {
        $createLinkAction->execute($request->validated(), auth()->user());

        return redirect()->route('community.thanks');
    }
}
