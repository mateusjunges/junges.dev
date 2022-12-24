<!doctype html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('layouts.partials.meta')
    @stack('head')
</head>

<body class="bg-blue-darkest tracking-wide text-white">

@include('layouts.partials.header')

<div class="flex-grow" role="main">
{{--    <div class="w-full p-2 md:mt-6 lg:mt-0 leading-normal bg-blue-darkest font-inter text-white">--}}
        {{ $slot }}
{{--        @yield('content')--}}
{{--    </div>--}}
{{--    @yield('on-this-page')--}}
</div>
<!--/container-->
{{--@include('layouts.partials.footer')--}}
@include('layouts.partials.scripts')
</body>
