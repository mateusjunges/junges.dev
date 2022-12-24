@php
    /** @var \App\Docs\Repository $repository */
    $latestVersion = $repository->getSortedAliases()->first();
@endphp


<x-page
    title="{{ $page->title }} | {{ $repository->slug }}"
    {{--    background="/backgrounds/docs-blur.jpg"--}}
    :no-index="$page->alias !== $latestVersion->slug"
    canonical="{{ url('/docs/' . $repository->slug . '/' . $latestVersion->slug . '/' . $page->slug) }}"
>
    <x-slot name="description">
        {{ $repository->slug }}
    </x-slot>


    @include('docs.partials.breadcrumbs')

    <section class="wrap md:grid pb-24 gap-12 md:grid-cols-10 items-stretch">
        <div class="z-10 | md:col-span-3 | lg:col-span-2 | print:hidden">
            @include('docs.partials.navigation')
        </div>
        <article class="md:col-span-7 lg:col-span-8">
            @if(count($repository->aliases) > 1)
                <div
                    class="mb-12 p-4 flex text-sm bg-gray-light bg-opacity-50 rounded-sm md:shadow-light markup-shiki">
                    <div
                        class="flex-none h-6 w-6 text-orange fill-current">{{ __svg('icons/fal-exclamation-circle') }}</div>
                    <div class="ml-4">
                        <p>
                            This is the documentation for
                            <strong>{{ $page->alias }}</strong>@if($page->alias !== $latestVersion->slug)
                                but the latest version is
                                <strong>{{ $latestVersion->slug }}</strong>
                            @endif.
                            You can switch versions in the menu <span
                                class="hidden md:inline">on the left</span><span
                                class="hidden">/</span><span class="inline md:hidden">at the top</span>.
                            Check your current version with the following command:
                        </p>
                        <div class="mt-2">
                            <code class="bg-gray-dark bg-opacity-50 px-2 py-1">
                                composer show mateusjunges/{{ $repository->slug }}
                            </code>
                        </div>
                    </div>
                </div>
            @endif

            <div>

            </div>
            <div class="mb-8"></div>

            @if($showBigTitle)
                <div class="mb-16">
                    <h1 class="banner-slogan">
                        {{ ucfirst($repository->slug) }}
                    </h1>
                    <div class="banner-intro flex items-center justify-start">
                        {{ $alias->slogan }}
                    </div>
                </div>

                <h2 class="title-xl mb-8">{{ $page->title }}</h2>
            @else
                <h1 class="title-xl mb-8">{{ $page->title }}</h1>
            @endif

            <div
                class="markup markup-titles markup-lists markup-code markup-tables markup-shiki markup-embeds links-underline">
                {!! $page->contents !!}
            </div>
        </article>

        @unless(request()->cookie('freelance-ad-dismissed') || (bool) config('junges_dev_advertising.freelance.enabled') === false)

            <aside class="hidden md:block w-48 pb-16 print-hidden right-px pin-t fixed"
                   style="right: 2px" id="freelance-ad">
                <div class="sticky top-0 py-6">
                    <div
                        class="pl-4 py-2 border-l-2 border-gray-light rounded bg-gray-light border-opacity-50">
                        <div class="flex justify-between items-center">
                            <h3 class="mb-3 text-black font-semibold uppercase tracking-wider text-xs">
                                Do you need help with this package?
                            </h3>
                        </div>
                        <p class="grid gap-2 text-xs">
                            I'm available for freelance projects. Contact me <a
                                href="mailto:mateus@junges.dev"
                                class="underline hover:cursor-pointer">via email</a>
                        </p>
                        <p class="text-right mr-2 text-xs underline hover:cursor-pointer"
                           id="close-ad">close</p>
                    </div>
                </div>
            </aside>

        @endunless

    </section>

    <script
        src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>

    <script>
        let close = document.getElementById('close-ad');

        close.addEventListener('click', closeAd);

        function closeAd() {
            document.getElementById('freelance-ad').remove();
            document.cookie = "freelance-ad-dismissed=true; expires=Thu, {{ now()->addWeek()->day }} {{ now()->addWeek()->format('M') }} {{ now()->addWeek()->year }} 12:00:00 UTC; path=/";
        }
    </script>
</x-page>
