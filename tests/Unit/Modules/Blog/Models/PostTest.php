<?php declare(strict_types=1);

namespace Tests\Unit\Modules\Blog\Models;

use Tests\Factories\PostFactory;
use Tests\TestCase;

/** @covers \App\Modules\Blog\Models\Post */
final class PostTest extends TestCase
{
    /** @test */
    public function it_can_determine_the_promotional_url(): void
    {
        $post = (new PostFactory())->original()->create([
            'title' => 'test',
            'send_automated_tweet' => false
        ]);

        $this->assertEquals("http://localhost:8000/$post->id-test", $post->promotional_url);
    }

    /** @test */
    public function it_can_determine_the_excerpt(): void
    {
        $post = (new PostFactory())->original()->create([
            'text' => 'excerpt<!--more-->full post',
        ]);

        $this->assertEquals('<p>excerpt</p>', $post->excerpt);
    }
}
