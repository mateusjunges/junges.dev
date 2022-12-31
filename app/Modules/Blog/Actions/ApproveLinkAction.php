<?php

namespace App\Modules\Blog\Actions;

use App\Modules\Blog\Mail\LinkApprovedMail;
use App\Modules\Blog\Models\Link;
use Illuminate\Support\Facades\Mail;
use Spatie\ResponseCache\Facades\ResponseCache;

final class ApproveLinkAction
{
    public function execute(Link $link): Link
    {
        if ($link->isApproved()) {
            return $link;
        }

        Mail::to($link->user->email)->queue(new LinkApprovedMail($link));

        $link->update([
            'publish_date' => now(),
            'status' => Link::STATUS_APPROVED,
        ]);

        ResponseCache::clear();

        return $link;
    }
}
