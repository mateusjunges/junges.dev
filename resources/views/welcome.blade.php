<!doctype html>
<html lang="en">
<head>
    @include('layouts.partials.meta', ['title' => 'Welcome!'])
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<livewire:styles>
@stack('head')
</head>

{{--{{ $slot ?? null}}--}}
{{--@yield("content")--}}

<body class="tracking-wide flex justify-center w-full md:w-2/5 mx-auto bg-black text-white">
{{--@include('layouts.partials.navbar')--}}
<div class="container w-screen flex flex-col md:flex-row bg-black text-white">
    @yield('sidebar')
    <div class="w-full mt-10 md:mt-10 lg:mt-6 text-black leading-normal font-inter text-white">
        <div class="m-auto mt-0 mx-4">
            <div class="w-full">
                <h1 class="text-5xl text-white font-super-bold leading-12">junges.dev</h1>
            </div>
            <div class="w-full">
                <h3 class="text-sm font-super-bold text-white uppercase">About Me</h3>
                <div>
                    <p class="leading-tight text-sm font-light">Mateus Junges. Software Engineer based in Brazil.</p>
                </div>
            </div>
            <dl class="mt-3 w-full">
                <dt class="text-sm font-super-bold text-white uppercase">Social Media</dt>
                <dd class="flex">
                    <div class="flex justify-between">
                        <a href="mailto:mateus@junges.dev" class="pr-2 text-white font-super-bold text-3xl cursor-pointer" target="_blank">{{ svg('mail') }}</a>
                        <a href="https://github.com/mateusjunges" class="pr-2 text-white font-super-bold text-3xl cursor-pointer" target="_blank">{{ svg('github-1') }}</a>
                        <a href="https://twitter.com/mateusjungess/" class="pr-2 text-white font-super-bold text-3xl cursor-pointer" target="_blank">{{ svg('twitter') }}</a>
                        <a href="https://www.linkedin.com/in/mateusjunges/" class="text-white font-super-bold text-3xl cursor-pointer" target="_blank">{{ svg('linkedin') }}</a>
                    </div>
                </dd>
            </dl>
            <div class="mt-10 font-inter text-">
{{--                <div class="experience flex flex-col bg-simple-black rounded py-4 px-2 hover:bg-gray-60 my-4">--}}
{{--                    <h3 class="font-super-bold">Experience - coming soon!</h3>--}}
{{--                    <h5 class="font-semibold text-sm">Is this the part recruiters like to talk about?</h5>--}}
{{--                </div>--}}
                <a href="{{ route('open-source') }}">
                    <div class="experience flex flex-col bg-simple-black rounded py-4 px-2 hover:bg-gray-100 my-4">
                        <h3 class="font-super-bold flex items-center">Open Source {{ svg('link') }}</h3>
                        <h5 class="font-light text-sm">Public projects I contributed through commits, issues, pull requests or reviews on Github</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>
</body>
