<nav id="header" class="fixed w-full z-10 pin-t bg-white -mt-16 shadow">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-4">
        <div class="pl-4 items-center">
            <a class="text-black text-base no-underline hover:no-underline font-extrabold text-xl"  href="#">
                JUNGES.DEV
            </a>
        </div>
        <div class="block lg:hidden pr-4">
            <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-grey border-grey-dark hover:text-black hover:border-purple appearance-none focus:outline-none">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                </svg>
            </button>
        </div>
        <div class="w-full lg:flex lg:content-center lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 z-20 justify-between" id="nav-content">
            {{ \Spatie\Menu\Laravel\Menu::navbar()
                ->addClass('list-reset lg:flex justify-end items-center')
                ->addItemClass('inline-block text-grey-dark no-underline hover:text-black hover:underline py-2 px-4')
                ->setActiveClass('font-bold text-black mb:border-b-2 mb:border-black')
                }}
        </div>
    </div>
</nav>
