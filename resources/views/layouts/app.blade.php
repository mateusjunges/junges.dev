<?php
/**
 * @var array<int, string> $class
 * @var array<int, string> $mainClasses
 */
$class ??= [];
$mainClasses ??= [];
?>

@include('layouts.head')

<body class="font-sans">
@include('layouts.navbar')
<div class="mx-auto @foreach($class as $c) {{ $c }} @endforeach">
    <div class="flex flex-col md:flex-row justify-between">
        <div class="md:flex pb-12">
            <main class="flex-1 px-4 md:px-12 lg:pl-12 @foreach($mainClasses as $class) {{ $class }} @endforeach">
                {{ $slot }}
            </main>
        </div>

        <div class="flex flex-col h-full items-center bg-gray-200 min-h-full rounded mr-0 md:mr-14">
            <p class="font-bold text-center py-8">
                Advertising
            </p>
            <a href="https://coinspaid.com/" class="px-8 py-4">
                <img src="https://laravelnews.s3.amazonaws.com/partners/coinspaid.png" alt="CoinsPaid" title="CoinsPaid" class="w-48 object-fit object-center h-auto">
            </a>
            <a href="https://coinspaid.com/" class="px-8 py-4">
                <img src="https://laravelnews.s3.amazonaws.com/partners/coinspaid.png" alt="CoinsPaid" title="CoinsPaid" class="w-48 object-fit object-center h-auto">
            </a>
            <a href="https://coinspaid.com/" class="px-8 py-4">
                <img src="https://laravelnews.s3.amazonaws.com/partners/coinspaid.png" alt="CoinsPaid" title="CoinsPaid" class="w-48 object-fit object-center h-auto">
            </a>
            <a href="https://coinspaid.com/" class="px-8 py-4">
                <img src="https://laravelnews.s3.amazonaws.com/partners/coinspaid.png" alt="CoinsPaid" title="CoinsPaid" class="w-48 object-fit object-center h-auto">
            </a>
            <a href="https://coinspaid.com/" class="px-8 py-4">
                <img src="https://laravelnews.s3.amazonaws.com/partners/coinspaid.png" alt="CoinsPaid" title="CoinsPaid" class="w-48 object-fit object-center h-auto">
            </a>
            <a href="https://coinspaid.com/" class="px-8 py-4">
                <img src="https://laravelnews.s3.amazonaws.com/partners/coinspaid.png" alt="CoinsPaid" title="CoinsPaid" class="w-48 object-fit object-center h-auto">
            </a>
            <a href="https://coinspaid.com/" class="px-8 py-4">
                <img src="https://laravelnews.s3.amazonaws.com/partners/coinspaid.png" alt="CoinsPaid" title="CoinsPaid" class="w-48 object-fit object-center h-auto">
            </a>
        </div>
    </div>
</div>

<livewire:scripts />
<x-comments::scripts />
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

