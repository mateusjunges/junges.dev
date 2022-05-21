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

<body class="bg-black tracking-wide text-white">
@include('layouts.partials.navbar')
<div class="container w-screen mx-auto px-2 pt-8 mt-16 flex flex-col md:flex-row">
    @yield('sidebar')
    <div class="w-full p-2 md:mt-6 lg:mt-0 leading-normal bg-black font-inter text-white">
        {{ $slot ?? null }}
        @yield('content')
    </div>
</div>
<!--/container-->
{{--@include('layouts.partials.footer')--}}
@include('layouts.partials.scripts')
</body>
