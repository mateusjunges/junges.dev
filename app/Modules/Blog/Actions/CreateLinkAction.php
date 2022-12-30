<?php declare(strict_types=1);

namespace App\Modules\Blog\Actions;

use App\Modules\Auth\Models\User;
use App\Modules\Blog\Mail\LinkSubmittedMail;
use App\Modules\Blog\Models\Link;
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
