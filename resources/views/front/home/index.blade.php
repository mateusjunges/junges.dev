<x-app-layout>
    @section('no-banner', true)
    <x-ad/>

    @include('front.posts.partials.list')

    {{ $posts->links() }}
</x-app-layout>
