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

        <x-sponsors :class="['mr-0', 'md:mr-14']" :sponsor-class="['flex-col']" :bg="'bg-gray-200'"></x-sponsors>
    </div>
</div>

<livewire:scripts />
<x-comments::scripts />
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

