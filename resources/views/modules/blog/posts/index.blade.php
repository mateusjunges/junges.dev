<x-page title="Originals">
    <div class="container wrap min-h-12">
        <div class="mb-4">
            <h1 class="font-semibold text-3xl">Originals</h1>
        </div>

        @include('modules.blog.posts.partials.list')

        {{ $posts->links() }}
    </div>
</x-page>

