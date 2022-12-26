<x-app title="Originals">
    <div class="min-h-12 font-sans">
        <div class="mb-4">
            <h1 class="font-semibold text-2xl">Originals</h1>
        </div>

        @include('modules.blog.posts.partials.list')

        {{ $posts->links() }}
    </div>
</x-app>

