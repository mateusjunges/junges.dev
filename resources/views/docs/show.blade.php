@php
    /** @var \App\Docs\Repository $repository */
    $latestVersion = $repository->aliases->first()
@endphp

<x-page
    title="{{ $page->title }} | {{ $repository->slug }}"
    background=""
    :no-index="$page->alias !== $latestVersion->slug"
    canonical="{{ url('/docs/' . $repository->slug . '/' . $latestVersion->slug . '/' . $page->slug) }}">
    <div class="flex flex-col">
        @include('docs.partials.breadcrumbs')
        <div class="font-inter w-full">
            <div class="pb-24 flex flex-col md:flex-row items-stretch">
                <div class="md:mr-8">
                    @include('docs.partials.navigation')
                </div>
                <article class="md:col-span-7 lg:col-span-6">
                    @if(count($repository->aliases) > 1)
                        <div class="mb-12 p-4 flex text-sm bg-opacity-50 rounded-sm md:shadow-light markup-code bg-simple-black">
                            <div class="flex-none h-6 w-6 text-orange fill-current">{{ svg('icons/fal-exclamation-circle') }}</div>
                            <div class="ml-4">
                                <p>
                                    This is the documentation for <strong>{{ $page->alias }}</strong>@if($page->alias !== $latestVersion->slug) but the latest version is
                                    <strong>{{ $latestVersion->slug }}</strong>@endif.
                                    You can switch versions in the menu <span class="hidden md:inline">on the left</span><span class="hidden">/</span><span class="inline md:hidden">at the top</span>.
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

                    @if($showBigTitle)
                        <div class="mb-16">
                            <h1 class="text-4xl font-inter font-super-bold">
                                {{ ucfirst($repository->slug) }}
                            </h1>
                            <div class="banner-intro flex items-center justify-start font-inter font-light">
                                {{ $alias->slogan }}
                            </div>
                        </div>

                        <h2 class="title-xl mb-8">{{ $page->title }}</h2>
                    @else
                        <h1 class="title-xl mb-8">{{ $page->title }}</h1>
                    @endif

                @if(count($tableOfContents))
                    <div class="lg:hidden p-6 bg-blue-lightest rounded-sm bg-opacity-25 mb-8">
                        <h3 class="mb-2 text-gray font-semibold uppercase tracking-wider text-xs">
                            On this page
                        </h3>
                        <ol class="grid gap-1">
                            @foreach($tableOfContents as $fragment => $title)
                                <li class="text-sm">
                                    <a href="#{{ $fragment }}">
                                        {{ $title }}
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                 @endif

                    <div class="markup markup-titles markup-lists markup-tables markup-code markup-embeds links-underline">
                        {!! $page->contents !!}
                    </div>

                </article>
                @if(count($tableOfContents))
                    <aside class="hidden lg:block pb-16 col-span-2 print-hidden">
                        <div class="sticky top-0 py-6">
                            <div class="pl-4 border-l-2 border-gray-light border-opacity-50" style="margin-top: 60px">
                                <h3 class="mb-3 text-gray font-super-bold uppercase tracking-wider text-xs">
                                    On this page
                                </h3>
                                <ul class="grid gap-2">
                                    @foreach($tableOfContents as $fragment => $title)
                                        <li class="text-sm">
                                            <a href="#{{ $fragment }}" class="docs-submenu-item">
                                                {{ $title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </aside>
                @endif
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>

    <script>
        docsearch({
            apiKey: '7a1f56fb06bd42e657e82bdafe86cef3',
            indexName: 'mateusjunges',
            inputSelector: '#algolia-search',
            debug: true,
            algoliaOptions: {
                'hitsPerPage': 5,
                'facetFilters': ['project:{{ $repository->slug }}', 'version:{{ $alias->slug }}']
            }
        });
    </script>
</x-page>
