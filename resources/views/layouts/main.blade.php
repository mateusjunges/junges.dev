<!doctype html>
<html lang="en">
<head>
    @include('layouts.partials.meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <livewire:styles>
    @stack('head')
</head>
<body class="flex items-center justify-center">
<div class="overflow-x-hidden bg-gray-100 w-screen">
    @include('layouts.nav')
    <div class="px-6 py-8">
        <div class="flex-grow" role="main">
            {{ $slot ?? null}}
            @yield("content")
        </div>
    </div>
    @include('layouts.partials.footer')
</div>
<livewire:scripts></livewire:scripts>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/alpine.js') }}"></script>
@stack('scripts')
</body>
</html>
