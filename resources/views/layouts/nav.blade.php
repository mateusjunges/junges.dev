<nav class="bg-white shadow-lg">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between">
            <div class="flex space-x-7">
                <div>
                    <a href="#" class="flex items-center py-4 px-2">

                        <span class="font-semibold text-gray-500 text-lg">JUNGES.DEV</span>
                    </a>
                </div>
            </div>

            <div class="hidden md:flex items-center space-x-3 ">
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('open-source') }}" class="py-4 px-2 text-green-500 border-b-4 border-green-500 font-semibold">Open Source Docs</a>
                </div>
            </div>

            <div class="md:hidden flex items-center">
                <button class="outline-none mobile-menu-button">
                    <svg class=" w-6 h-6 text-gray-500 hover:text-green-500 "
                         x-show="!showMenu"
                         fill="none"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                    >
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- mobile menu -->
    <div class="hidden mobile-menu">
        <ul class="">
            <li class="active">
                <a href="{{ route('open-source') }}" class="block text-sm px-2 py-4 hover:bg-gray-200 transition duration-300">Open Source Docs</a>
            </li>
        </ul>
    </div>
    <script>
        const btn = document.querySelector("button.mobile-menu-button");
        const menu = document.querySelector(".mobile-menu");

        btn.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });
    </script>
</nav>
