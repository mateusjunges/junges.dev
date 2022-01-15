<!doctype html>
<html lang="en">
<head>
    @include('layouts.v2.partials.meta')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <livewire:styles>
    @stack('head')
</head>

{{--{{ $slot ?? null}}--}}
{{--@yield("content")--}}

<body class="bg-grey-lightest tracking-wide">
@include('layouts.v2.partials.navbar')
<div class="container w-full flex flex-wrap mx-auto px-2 pt-8 lg:pt-16 mt-16">
    @include('layouts.v2.partials.sidebar')
    <div class="w-full lg:w-4/5 p-8 mt-6 lg:mt-0 text-black leading-normal bg-white">
@include('posts.preview')
@include('posts.preview')
@include('posts.preview')
@include('posts.preview')
    </div>
</div>
<!--/container-->
@include('layouts.v2.partials.footer')
@include('layouts.v2.partials.scripts')
</body>
