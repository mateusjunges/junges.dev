<?php declare(strict_types=1);

namespace App\Services\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Contracts\Twitter as TwitterContract;

final class Twitter implements TwitterContract
{
    protected TwitterOAuth $twitter;

    public function __construct(TwitterOAuth $twitter)
    {
        $this->twitter = $twitter;
    }

    public function tweet(string $status): array|bool
    {
        if (! app()->environment('production')) {
            return false;
        }

        return (array) $this->twitter->post('statuses/update', ['status' => $status]);
    }
}
