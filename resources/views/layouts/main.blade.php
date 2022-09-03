<!doctype html>
<html lang="en">
<head>
    @include('layouts.partials.meta')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <livewire:styles>
    @stack('head')
</head>

{{--{{ $slot ?? null}}--}}
{{--@yield("content")--}}

<body class="bg-blue-darkest tracking-wide text-white">
@include('layouts.partials.navbar')
<div class="container w-screen mx-auto px-2 pt-8 mt-16 flex flex-col md:flex-row">
    <div class="w-full p-2 md:mt-6 lg:mt-0 leading-normal bg-blue-darkest font-inter text-white">
        {{ $slot ?? null }}
        @yield('content')
    </div>
    @yield('on-this-page')
</div>
<!--/container-->
{{--@include('layouts.partials.footer')--}}
@include('layouts.partials.scripts')
</body>
