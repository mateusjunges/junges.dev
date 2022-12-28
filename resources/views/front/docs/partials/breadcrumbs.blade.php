<section id="breadcrumb"
         class="hidden md:block container py-4 md:py-4 items-stretch">
    <div class="px-4">
        <p class="mt-4">
            <a href="{{ route('docs.index')}}" class="link-underline">Docs</a>
            <span class="icon mx-2 opacity-50 fill-current">{{ __svg('icons/far-angle-right') }}</span>
            <a
                    class="link-underline"
                    href="{{ action([\App\Modules\Docs\Http\Controllers\DocsController::class, 'repository'], [$repository->slug, $alias->slug]) }}"
            >{{ ucfirst($repository->slug) }}</a>
            @if(! $page->isRootPage())
                <span class="icon mx-2 opacity-50 fill-current text-blue">{{ __svg('icons/far-angle-right') }}</span>
                <span>{{ ucfirst($page->section) }}</span>
            @endif
            <span class="icon mx-2 opacity-50 fill-current text-blue">{{ __svg('icons/far-angle-right') }}</span>
            <span>{{ $page->title }}</span>
        </p>
    </div>
</section>
