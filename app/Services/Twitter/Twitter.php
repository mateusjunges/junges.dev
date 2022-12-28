<?php declare(strict_types=1);

namespace App\Services\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;

final class Twitter
{
    protected TwitterOAuth $twitter;

    public function __construct(TwitterOAuth $twitter)
    {
        $this->twitter = $twitter;
    }

    public function tweet(string $status): ?array
    {
        if (! app()->environment('production')) {
            return null;
        }

        return (array) $this->twitter->post('statuses/update', compact('status'));
    }
}
