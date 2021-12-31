@extends('layouts.main')

@section('content')
    <div class="w-full">
        <div class="items-center justify-between">
            <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Open source packages</h1>
            <div>

            </div>
        </div>
        <div class="w-full h-12 bg-black mt-6">
            <div class="max-w-full px-10 py-6 mx-auto bg-white rounded-lg shadow-md">
                <div class="mt-2">
                    <a href="https://github.com/mateusjunges/laravel-kafka" class="underline text-2xl font-bold text-gray-700 hover:underline">
                        mateusjunges/laravel-kafka
                    </a>
                    <p class="mt-2 text-gray-600">
                        Do you use Kafka in your laravel projects? All packages I've seen until today, including some built by myself, does not provide a nice syntax usage syntax or, if it does, the test process with these packages are very painful.
                        This package provides a nice way of producing and consuming kafka messages in your Laravel projects.
                        Follow these docs to install this package and start using kafka in your laravel projects.
                    </p>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <a href="#" class="text-blue-500 hover:underline">View documentation</a>
                    <div>
                        <a href="#" class="flex items-center">
                            <svg width="18" height="18" viewBox="0 0 24 24" class="mr-2"><path fill="black" d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            <h1 class="font-bold text-gray-700 hover:underline"> View on github</h1>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
