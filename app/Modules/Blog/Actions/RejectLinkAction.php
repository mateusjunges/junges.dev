<?php

namespace App\Modules\Blog\Actions;

use App\Modules\Blog\Models\Link;

class RejectLinkAction
{
    public function execute(Link $link): Link
    {
        $link->update(['status' => Link::STATUS_REJECTED]);

        return $link;
    }
}
