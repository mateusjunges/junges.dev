<x-error-layout :title="'Page not found'">
    <div class="flex flex-col items-center justify-center max-w-lg">
        <div class="mb-4">
            <h1 class="text-6xl font-extrabold text-blue-800">404</h1>
        </div>
        <h3 class="mb-3 text-2xl font-bold text-center text-gray-700">
           Page not found
        </h3>
        <p class="text-sm text-center text-gray-600 px-4">
            Sorry, but the page you were trying to view does not exist.
        </p>
        <div>
            <a href="{{ config('app.url') }}">
                <button class="button-blue py-4 px-12 rounded text-white my-4 hover:bg-white hover:text-black hover:border-blue-800 hover:border-2">
                    Go home
                </button>
            </a>
        </div>
    </div>
</x-error-layout>
