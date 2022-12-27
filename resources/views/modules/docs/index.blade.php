@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

<x-app title="Documentation">
    <div class="container wrap border-r-3 h-full border-r border-gray-500">
        <div>
            <h1 class="banner-slogan text-2xl mt-4 md:mt-0 font-bold text-black md:text-4xl">Docs</h1>
            <p class="mt-4 text-lg">
                In this page you can find the documentation for all of my open source packages available
                <a href="https://github.com/mateusjunges" class="underline font-bold">at github</a>.
            </p>
        </div>
        <div class="mt-6">
            @foreach($repositories->groupBy('category') as $category => $repositories)
                <div class="mb-24">
                    <ol class="flex flex-wrap list-none">
                        @foreach($repositories as $repository)
                            @include('modules.docs.partials.repository', ['githubRepositories' => $githubRepositories])
                        @endforeach
                    </ol>
                </div>
            @endforeach
        </div>
    </div>
</x-app>
<x-support></x-support>

