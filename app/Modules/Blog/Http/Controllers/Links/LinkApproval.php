<?php

namespace App\Modules\Blog\Http\Controllers\Links;

use App\Modules\Blog\Actions\ApproveLinkAction;
use App\Modules\Blog\Actions\CreatePostFromLinkAction;
use App\Modules\Blog\Actions\RejectLinkAction;
use App\Modules\Blog\Models\Link;

final class LinkApproval
{
    public function approve(Link $link, ApproveLinkAction $approveLinkAction)
    {
        $approveLinkAction->execute($link);

        return view('front.links.approved');
    }

    public function approveAndCreatePost(
        Link $link,
        ApproveLinkAction $approveLinkAction,
        CreatePostFromLinkAction $createPostFromLinkAction
    ) {
        $approveLinkAction->execute($link);

        $createPostFromLinkAction->execute($link);

        return view('front.links.approved-and-post-created');
    }

    public function reject(Link $link, RejectLinkAction $rejectLinkAction)
    {
        $rejectLinkAction->execute($link);

        return view('front.links.rejected');
    }
}
