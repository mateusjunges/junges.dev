<?php

namespace App\Providers;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Contracts\Twitter as TwitterContract;
use App\Services\Twitter\Twitter;
use Illuminate\Support\ServiceProvider;

class TwitterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TwitterContract::class, function () {
            $connection = new TwitterOAuth(
                config('services.twitter.consumer_key'),
                config('services.twitter.consumer_secret'),
                config('services.twitter.access_token'),
                config('services.twitter.access_token_secret')
            );

            return new Twitter($connection);
        });
    }
}
