<div>
@if ($nextPost)
    This series is continued in <a href="{{ route('posts.show', $nextPost->slug) }}">{{   lcfirst($nextPost->series_toc_title) }}</a>.
@endif
</div>
