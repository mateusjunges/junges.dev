<x-app title="Originals"
       :main-classes="['max-w-3xl']">
{{--       :class="['max-w-xl', 'md:max-w-3xl']">--}}
    <div class="min-h-12 font-sans">
        <div class="mb-4">
            <h1 class="font-semibold text-2xl">Originals</h1>
        </div>

        @include('modules.blog.posts.partials.list')

        {{ $posts->links() }}
    </div>
</x-app>

