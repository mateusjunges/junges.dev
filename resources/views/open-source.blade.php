
@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

<x-page
    title="Welcome!" background="">
    <h1 class="banner-slogan text-2xl font-bold text-gray-700 md:text-4xl mb-6">Open Source</h1>
    <p>
        Since I use Laravel for most of my projects, I build open source projects to contribute to the awesome Laravel ecosystem.
        When I discover a functionality in my projects that can be useful for others, then I extract it into an open source package. Take a look
        at my repositories:
    </p>
    <livewire:repositories/>
</x-page>