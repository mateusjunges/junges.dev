<div class="w-screen fixed top-0 bg-blue-dark z-50" x-show="bannerOpen">
    <div class="mx-auto flex max-w-container items-center justify-center gap-2 py-2 pl-5 pr-12 text-center uppercase tracking-wider text-white sm:px-12">
        {{ $slot }}
    </div>
    <div class="absolute inset-y-0 right-5 flex items-center">
        <button class="text-white transition hover:text-white/80" type="button" @click="bannerOpen = false">
            <span class="sr-only">Close</span>
            <x-icons.close class="size-6 text-white"/>
        </button>
    </div>
</div>