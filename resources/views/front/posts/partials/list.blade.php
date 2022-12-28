@foreach($posts as $post)
    @if($loop->index === 2)
        <div class="mb-12 md:mb-24 md:-mt-4">
            @include('front.layouts.partials.support')
        </div>
    @endif

    <x-post-header
        :post="$post"
        class="mb-12 md:mb-24'"
        :url="$post->external_url ?: $post->url"
        heading="h2"
    >

        {!! $post->excerpt !!}

        @unless($post->isTweet())
            <p class="mt-6">
                @if($post->external_url)
                    <a href="{{ $post->external_url }}">
                        Read more</a>
                    <span class="text-xs text-gray-700">[{{ $post->externalUrlHost() }}]</span>
                @else
                    <a href="{{ $post->url }}">
                        Read more
                    </a>
                @endif
            </p>
        @endunless
    </x-post-header>
@endforeach
