<?php

declare(strict_types=1);

namespace App\Modules\Blog\Jobs;

use App\Modules\Blog\Models\Post;
use App\Services\Twitter\Twitter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class TweetPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public object $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function handle(Twitter $twitter)
    {
        if (! $this->post->send_automated_tweet) {
            return;
        }

        if ($this->post->tweet_sent) {
            return;
        }

        if ($this->post->isTweet()) {
            return;
        }

        $tweetText = $this->post->toTweet();

        $tweetResponse = $twitter->tweet($tweetText);

        if (! isset($tweetResponse['id_str'])) {
            return;
        }

        $tweetUrl = "https://twitter.com/mateusjunges/status/{$tweetResponse['id_str']}";

        $this->post->onAfterTweet($tweetUrl);

        $this->post->update(['tweet_sent' => true]);
    }
}
