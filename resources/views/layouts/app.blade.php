@include('layouts.head')

<body class="font-sans">
<div class="max-w-xl md:max-w-3xl mx-auto">
    <header class="mt-8 md:mt-12 mb-8 sm:mb-12 md:mb-16 px-4 md:px-8 leading-tight">
        <div class="border-b pb-4">
            <h1 class="text-center text-lowercase font-extrabold text-2xl">
                <a href="">junges.dev</a>
            </h1>
        </div>
    </header>
    <div class="md:flex pb-12">
        <nav class="hidden md:block w-1/4 lg:w-1/5 text-center leading-loose">
            <div class=" border-gray-200 px-8 mb-16">
                {{ Menu::primary()
                    ->addClass('text-gray-700 mb-6')
                    ->setActiveClass('font-bold text-black') }}
                {{ Menu::secondary()
                    ->addClass('text-xs text-gray-700')
                    ->setActiveClass('font-semibold text-black') }}
            </div>
            <div class="pl-8">
{{--                @include('layouts.partials.carbon')--}}
            </div>
        </nav>
        <main class="flex-1 min-w-0 px-4 md:px-12 lg:pl-24 lg:pr-16">
            {{ $slot }}
        </main>
    </div>
</div>

<livewire:scripts />
<x-comments::scripts />
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

