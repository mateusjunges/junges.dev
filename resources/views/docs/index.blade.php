@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

<x-page title="Documentation">
    <div class="min-h-12">
        <div>
            <h1 class="banner-slogan text-2xl font-bold text-gray-700 md:text-4xl">Docs</h1>
            <p class="mt-4 text-lg">
                In this page you can find the documentation for all of my open source packages available
                <a href="https://github.com/mateusjunges" class="underline font-bold">at github</a>.
            </p>
        </div>
{{--        <div class="search mt-6">--}}
{{--            <div class="container flex w-full">--}}
{{--                <div class="flex border mx-auto w-full">--}}
{{--                    <button class="flex items-center justify-center px-4">--}}
{{--                        <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 24 24">--}}
{{--                            <path--}}
{{--                                d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z">--}}
{{--                            </path>--}}
{{--                        </svg>--}}
{{--                    </button>--}}
{{--                    <input type="text" class="px-4 py-2 w-80" placeholder="Looking for an specific repository?">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="mt-6">
            @foreach($repositories->groupBy('category') as $category => $repositories)
                <div class="mb-24">
                    <ol class="flex flex-wrap list-none">
                        @foreach($repositories as $repository)
                            @include('docs.partials.repository', ['githubRepositories' => $githubRepositories])
                        @endforeach
                    </ol>
                </div>
            @endforeach
        </div>
    </div>
</x-page>

