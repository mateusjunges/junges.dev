<x-page title="Documentation">
    <div class="h-screen">
        <div>
            <h1 class="banner-slogan text-xl font-bold text-gray-700 md:text-2xl">Docs</h1>
            <p class="banner-intro mt-4 text-lg">
                Documentation for all of my open source packages
            </p>
        </div>
        <div class="mt-6 ml-0">
            @foreach($repositories->groupBy('category') as $category => $repositories)
{{--                    <div class="wrap">--}}
{{--                        <h2 class="title underline font-bold text-2xl text-gray-700 mb-12">{{ $category }}</h2>--}}
{{--                    </div>--}}
                <div class="mb-24">
                    <div class="flex flex-wrap -mb-4">
                        @each('docs.partials.repository', $repositories, 'repository')
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-page>

