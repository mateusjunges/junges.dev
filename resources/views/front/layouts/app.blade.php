@include('front.layouts.partials.head')

<body>

<div class="font-sans text-black">
    @include('front.layouts.partials.flash')

    <div class="max-w-xl md:max-w-7xl mx-auto">
        <header class="mt-8 md:mt-12 mb-8 sm:mb-12 md:mb-16 px-4 md:px-8 leading-tight">
            <div class="md:flex items-end justify-between">
                <div class="">
                    <h1 class="text-lg uppercase tracking-wider font-extrabold">
                        <a href="/">junges.dev</a>
                    </h1>
                </div>
                <div class="hidden">
                    {{ Menu::primary()
                        ->addClass('text-gray-700 px-6 flex')
                        ->each(function (\Spatie\Menu\Laravel\Link $item) {
                            $item->addClass('px-4');
                        })
                        ->setActiveClass('font-bold text-black') }}
                </div>
            </div>
            <nav class="md:hidden mt-4 flex flex-col w-full">
                <input class="hidden" type="checkbox" id="mobile-menu-toggle" />
                <label
                    for="mobile-menu-toggle"
                    class="bg-gray-700 border-b-3 border-gray-900 w-full text-center text-white uppercase tracking-wider font-semibold p-2 pb-1"
                    style="top: -6rem; right: 0"
                >
                    Menu
                </label>
                <div class="mobile-menu | pt-4 text-right leading-loose">
                    {{ Menu::primary()
                        ->addClass('text-gray-700 mb-2 md:mb-6')
                        ->setActiveClass('font-bold text-black') }}
                    {{ Menu::secondary()
                        ->addClass('text-xs text-gray-700')
                        ->setActiveClass('font-semibold text-black') }}
                </div>
            </nav>
        </header>
        <div class="md:flex pb-12">
            <nav class="hidden md:block w-1/4 lg:w-1/5 text-right leading-loose">
                <div class="border-r border-gray-200 px-8 mb-16">
                    {{ Menu::primary()
                        ->addClass('text-gray-700 mb-6')
                        ->setActiveClass('font-bold text-black') }}
                    {{ Menu::secondary()
                        ->addClass('text-xs text-gray-700')
                        ->setActiveClass('font-semibold text-black') }}
                </div>
                <div class="pl-8">
{{--                    @include( 'front.layouts.partials.carbon')--}}
                </div>
            </nav>
            <main class="flex-1 min-w-0 px-4 md:px-12 lg:pl-24 lg:pr-16">
                {{ $slot }}
            </main>
            <div>
                @include('front.layouts.partials.sponsors')
            </div>
        </div>
    </div>
</div>

<livewire:scripts />
<x-comments::scripts />
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>


