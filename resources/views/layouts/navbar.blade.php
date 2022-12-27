<header class="flex justify-between mx-auto flex-col bg-gray-200 mb-4">
    <nav class="flex justify-between w-full px-4 py-6 mx-auto">
        <div class="items-center mx-auto">
            <div class="md:items-center mx-auto flex flex-col w-full">
                <div class="mx-auto py-2 mb-2">
                    <a href="https://junges.dev" aria-label="Home" class="flex items-center mr-5">
                        <p class="font-display uppercase ext-brand-500 ml-2 mr-4 text-xl font-bold leading-normal">
                            junges.dev
                        </p>
                    </a>
                </div>
                <div class="mx-auto">
                    {{
	                    Menu::primary()
	                        ->each(function (\Spatie\Menu\Laravel\Link $item) {
                                $item->addClass('px-4');
                            })
	                        ->addClass('font-display mx-4 lg:mx-3 text-xl font-medium tracking-tight text-center py-2 md:py-0 md:flex')
	                        ->setActiveClass('font-bold text-black underline')
                    }}
                </div>
            </div>
        </div>
    </nav>
</header>
