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
{{--            <div class="flex-1 w-full mx-auto max-w-sm content-center py-4 lg:py-0">--}}
{{--                <div class="relative pull-right pl-4 pr-4 md:pr-0">--}}
{{--                    <input type="search" placeholder="Search" class="w-full bg-grey-lightest text-sm text-grey-darkest transition border focus:outline-none focus:border-purple rounded py-1 px-2 pl-10 appearance-none leading-normal">--}}
{{--                    <div class="absolute search-icon" style="top: 0.375rem;left: 1.75rem;">--}}
{{--                        <svg class="fill-current pointer-events-none text-grey-darkest w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">--}}
{{--                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <ul class="list-reset lg:flex justify-end items-center">
                <li class="mr-3 py-2 lg:py-0">
                    <a class="inline-block py-2 px-4 text-black font-bold no-underline" href="#">Open Source</a>
                </li>
                <li class="mr-3 py-2 lg:py-0">
                    <a class="inline-block text-grey-dark no-underline hover:text-black hover:underline py-2 px-4" href="#">Blog</a>
                </li>
                <li class="mr-3 py-2 lg:py-0">
                    <a class="inline-block text-grey-dark no-underline hover:text-black hover:underline py-2 px-4" href="#">CV</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
