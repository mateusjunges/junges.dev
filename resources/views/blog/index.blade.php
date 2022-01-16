
@section('sidebar')
    @include('layouts.partials.sidebar')
@endsection

<x-page
    title="Welcome!" background="">
    <div class="flex flex-col">
        @include('posts.preview')
        @include('posts.preview')
        @include('posts.preview')
        @include('posts.preview')
        @include('posts.preview')
        @include('posts.preview')
    </div>
</x-page>
