<section id="breadcrumb" class="hidden md:block container wrap py-4 md:py-6 lg:py-8 items-stretch">
    <div class="px-4">
        <p class="mt-4">
            <a href="{{ route('docs')}}" class="link-underline">Docs</a>
            <span class="icon mx-2 opacity-50 fill-current text-blue">{{ svg('icons/far-angle-right') }}</span>
            <a
                class="link-underline"
                href="{{ action([\App\Http\Controllers\Docs\DocsController::class, 'repository'], [$repository->slug, $alias->slug]) }}"
            >{{ ucfirst($repository->slug) }}</a>
            @if(! $page->isRootPage())
                <span class="icon mx-2 opacity-50 fill-current text-blue">{{ svg('icons/far-angle-right') }}</span>
                <span>{{ ucfirst($page->section) }}</span>
            @endif
            <span class="icon mx-2 opacity-50 fill-current text-blue">{{ svg('icons/far-angle-right') }}</span>
            <span>{{ $page->title }}</span>
        </p>
    </div>
</section>
