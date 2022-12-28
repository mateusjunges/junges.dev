<html>
<head>
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="https://cloud.typography.com/6194432/6581412/css/fonts.css"/>
</head>
<body>
<div class="min-h-screen bg-gray-900 py-6 flex flex-col justify-center sm:py-12 p-20">
    <div class="relative py-3">
        <div
            class="absolute inset-0 bg-gradient-to-r {{ $post->gradientColors() }} shadow-lg transform skew-y-0 -rotate-5 sm:rounded-3xl"></div>
        <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-10">
            <div class="mx-auto">
                <div class="divide-y divide-gray-200">
                    <div class="pb-4 text-base space-y-4 leading-9">
                        <p class="text-3xl font-bold">{{ $post->title }}</p>
                    </div>
                    <div class="pt-6 text-base leading-6 font-bold sm:text-lg sm:leading-7">
                        <div class="md:flex items-end">
                            <figure class="w-12 inline-block mb-1 md:mb-0 md:mr-3">
                                <a href="/" title="junges.dev">
                                    junges.dev
                                </a>
                            </figure>
                            <div>
                                <h1 class="text-lg uppercase tracking-wider font-extrabold">
                                    <a href="/">junges.dev</a>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
