<div
    class="-mx-4 mb-8 sm:mx-0 p-4 sm:p-6 md:p-8 bg-gray-100 border-b-5 border-gray-200 text-sm text-gray-700 {{ $class ?? '' }}">
    @foreach($allPostsInSeries as $post)
        <ul class="list-none">
            <li>
                @if ($post->id === $currentPost->id)
                    {{ $post->series_toc_title }} <span class="font-italic font-light">(you are here)
                @else
                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->series_toc_title }}</a>
                @endif
            </li>
        </ul>
    @endforeach
</div>

