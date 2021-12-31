<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="flex items-center justify-center" style="background: #edf2f7;">
<div class="overflow-x-hidden bg-gray-100 w-screen">
    @include('layouts.nav')
    <div class="px-6 py-8">
        <div class="container flex justify-between mx-auto">
            @yield('content')
        </div>
    </div>
    @include('layouts.footer')
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
