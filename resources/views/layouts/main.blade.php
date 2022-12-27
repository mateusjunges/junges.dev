<!doctype html>
<html lang="en">
<head>
    {{ \Illuminate\Support\Facades\Vite::useBuildDirectory('/frontend-assets') }}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('layouts.partials.meta')
    @stack('head')
</head>

<body class="bg-white tracking-wide text-black">

@include('layouts.header')

<div class="flex-grow" role="main">
    {{ $slot }}
</div>
@include('layouts.partials.scripts')
</body>
