<?php

namespace App\Modules\Blog\Actions;

use App\Modules\Blog\Models\Link;

final class RejectLinkAction
{
    public function execute(Link $link): Link
    {
        $link->update(['status' => Link::STATUS_REJECTED]);

        return $link;
    }
}
