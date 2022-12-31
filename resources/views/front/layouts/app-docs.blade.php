@include('front.layouts.partials.head')

<body>

<div class="font-sans text-black">
    @include('front.layouts.partials.flash')

    <div class="max-w-xl md:max-w-8xl mx-auto">
        <header class="mt-8 md:mt-12 mb-8 px-4 leading-tight">
            <div class="flex items-center justify-between">
               <div class="flex flex-row justify-center mx-auto md:m-0 items-center">
                   <figure class="w-12 inline-block mb-1 md:mb-0 mr-3">
                       <a href="/" title="Freek.dev">
                           <img src="{{ asset('images/icon.png') }}" class="w-full" alt="Junges.dev logotype" />
                       </a>
                   </figure>
                   <div>
                       <h1 class="text-lg uppercase tracking-wider font-extrabold">
                           <a href="/">junges.dev</a>
                       </h1>
                   </div>
               </div>
                <div class="hidden md:block flex">
                    {{ Menu::primary()
                        ->addClass('text-gray-700 flex')
                        ->each(function (\Spatie\Menu\Laravel\Link $item) {
                            $item->addClass('pl-4 hover:underline');
                        })
                        ->setActiveClass('font-bold text-black') }}

                    {{ Menu::secondary(false)
                       ->addClass('text-xs text-gray-700 flex items-center justify-end mt-2')

                       ->each(function (\Spatie\Menu\Laravel\Link $item) {
                            $item->addClass('pl-2 hover:underline');
                        })
                       ->setActiveClass('font-semibold text-black') }}
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
                <div class="mobile-menu | pt-4 text-center leading-loose">
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
            <main class="flex-1 min-w-0">
                {{ $slot }}
            </main>
            <div class="mt-12 min-h-full">
                @include('front.layouts.partials.sponsors')
            </div>
        </div>
    </div>
</div>

<livewire:scripts />
<x-comments::scripts />
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>


