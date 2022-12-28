<?php declare(strict_types=1);

namespace App\Modules\Blog\Actions;

use App\Mail\LinkSubmittedMail;
use App\Models\Link;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

final class CreateLinkAction
{
    public function execute(array $linkAttributes, User $user): void
    {
        $link = Link::query()->create([
            'title' => $linkAttributes['title'],
            'url' => $linkAttributes['url'],
            'text' => $linkAttributes['text'] ?? '',
            'user_id' => $user->id,
        ]);

        Mail::to('mateus@junges.dev')->queue(new LinkSubmittedMail($link));
    }
}
