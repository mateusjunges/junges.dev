<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    @vite('resources/js/app.js')
</head>

    <body>
        <div class="flex items-center justify-center h-screen">
            @if($slot->toHtml() !== '')
                {{ $slot }}
            @else
                <div class="flex flex-col items-center justify-center max-w-lg">
                    <div class="mb-4">
                        <h1 class="text-6xl font-extrabold text-blue-800">{{ $errorCode }}</h1>
                    </div>
                    <h3 class="mb-3 text-2xl font-bold text-center text-gray-700">
                        {{ $errorMessage }}
                    </h3>
                    <p class="text-sm text-center text-gray-600 px-2">
                       {!! $errorDescriptionHtml !!}
                    </p>
                    <p class="text-sm text-center text-gray-600">
                        — Mateus Junges
                    </p>
                </div>
            @endif
        </div>
    </body>
</html>
