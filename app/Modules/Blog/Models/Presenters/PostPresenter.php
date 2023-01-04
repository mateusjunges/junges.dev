<?php

namespace App\Modules\Blog\Models\Presenters;

use App\Modules\Blog\Models\Post;
use App\Services\CommonMark\CommonMark;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

/**
 * @property-read string $excerpt The post excerpt.
 * @mixin Post
 */
trait PostPresenter
{
    public function excerpt(): Attribute
    {
        return new Attribute(
            get: function () {
                $excerpt = $this->getManualExcerpt() ?? $this->getAutomaticExcerpt();

                $excerpt = str_replace(
                    '<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>',
                    '<div data-lazy="twitter"></div>',
                    $excerpt,
                );

                $excerpt = CommonMark::convertToHtml($excerpt);

                return Str::limit(trim($excerpt), 250);
            }
        );
    }

    public function plainTextExcerpt(): string
    {
        return strip_tags($this->excerpt);
    }

    protected function getManualExcerpt(): ?string
    {
        if (! Str::contains($this->text, '<!--more-->')) {
            return null;
        }

        return trim(Str::before($this->text, '<!--more-->'));
    }

    protected function getAutomaticExcerpt(): ?string
    {
        if (! $this->original_content) {
            return $this->html;
        }

        $excerpt = $this->html;

        $excerpt = Str::before($excerpt, '<blockquote>');

        $excerpt = strip_tags($excerpt);

        //replace multiple spaces
        $excerpt = preg_replace("/\s+/", ' ', $excerpt);

        if (strlen($excerpt) == 0) {
            return '';
        }

        if (strlen($excerpt) <= 300) {
            return $excerpt;
        }

        $ww = wordwrap($excerpt, 300, "\n");

        $excerpt = substr($ww, 0, strpos($ww, "\n")).'…';

        return $excerpt ?? '';
    }


    public function relatedEmoji(): string
    {
        if ($this->isLink()) {
            return '🔗';
        }

        if ($this->isTweet()) {
            return '🐦';
        }

        if ($this->isOriginal()) {
            return '🌟';
        }

        return '';
    }

    public function formattedType(): string
    {
        if ($this->isOriginal()) {
            return 'Original';
        }

        return ucfirst($this->getType());
    }

    public function theme(): string
    {
        $tagNames = $this->tags->pluck('name');

        if ($tagNames->contains('laravel')) {
            return '#f16563';
        }

        if ($tagNames->contains('php')) {
            return '#7578ab';
        }

        return '#355a97';
    }

    public function gradientColors(): string
    {
        $tagNames = $this->tags->pluck('name');

        if ($tagNames->contains('laravel')) {
            return 'from-red-400 to-red-700';
        }

        if ($tagNames->contains('php')) {
            return 'from-blue-500 to-blue-800';
        }

        if ($tagNames->contains('javascript')) {
            return 'from-yellow-400 to-orange-500';
        }

        return 'from-gray-400 to-gray-700';
    }

    public function readingTime(): int
    {
        return (int) ceil(str_word_count(strip_tags($this->text)) / 200);
    }

    public function externalUrlHost(): string
    {
        return parse_url($this->external_url)['host'] ?? '';
    }

    public function seriesTocTitle(): string
    {
        $titleAfterPart = Str::after($this->title, 'part');

        return "Part{$titleAfterPart}";
    }
}
