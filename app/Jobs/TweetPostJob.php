<?php

namespace App\Jobs;

use App\Contracts\Twitter;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TweetPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Post $post
    ){
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

        if (! $tweetResponse || ! isset($tweetResponse['id_str'])) {
            return;
        }

        $tweetUrl = "https://twitter.com/mateusjungess/status/{$tweetResponse['id_str']}";

        $this->post->onAfterTweet($tweetUrl);

        $this->post->update(['tweet_sent' => true]);
    }
}
