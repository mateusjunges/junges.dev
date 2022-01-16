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

<body class="bg-grey-lightest tracking-wide">
@include('layouts.partials.navbar')
<div class="container w-screen mx-auto px-2 pt-8 mt-16">
{{--    @includeIf('layouts.partials.sidebar')--}}
    <div class="w-full p-2 md:mt-6 lg:mt-0 text-black leading-normal bg-white">
        {{ $slot ?? null }}
        @yield('content')
    </div>
</div>
<!--/container-->
@include('layouts.partials.footer')
@include('layouts.partials.scripts')
</body>
