@extends('layouts.main')

@section('content')
    <div class="w-full lg:w-8/12">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Post</h1>
            {{--                    <div>--}}
            {{--                        <select--}}
            {{--                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">--}}
            {{--                            <option>Latest</option>--}}
            {{--                            <option>Last Week</option>--}}
            {{--                        </select>--}}
            {{--                    </div>--}}
        </div>
        <div class="mt-6">
            @include('posts.preview')
        </div>


    </div>
    <div class="hidden w-4/12 -mx-8 lg:block min-h-full">
        <div class="px-8">
            <h1 class="mb-4 text-xl font-bold text-gray-700">Authors</h1>
            <div class="flex flex-col max-w-sm px-6 py-4 mx-auto bg-white rounded-lg shadow-md">
                <ul class="-mx-4">
                    @include('authors.author')
                </ul>
            </div>
        </div>
        <div class="px-8 mt-10">
            @include('categories.list')
        </div>
    </div>
@endsection
