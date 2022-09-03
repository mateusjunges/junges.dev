<div class="w-screen md:w-1/2 border-opacity-25 px-2 md:px-0 min-h-90px my-4 border-l-2 border-white">
    <div class="bg-blue-darkest flex flex-col justify-between px-4">
        <div class="mt-2">
            <a href="{{ action([\App\Http\Controllers\Docs\DocsController::class, 'repository'], $repository->slug) }}" class="text-2xl font-bold text-white hover:underline">
                mateusjunges/{{ $repository->slug }}
            </a>
            <p class="mt-2 text-white px-2">
                {{ optional($repository->aliases->last())->slogan }}
            </p>
        </div>
        <div class="mt-2 text-xs grid grid-flow-col gap-2 justify-start items-center">
            Available Versions:
            @foreach($repository->aliases as $alias)
                <span>
                    <a class="inline-flex items-center justify-center rounded-full w-8 h-8 px-2 bg-opacity-50 hover:bg-opacity-100 hover:font-super-bold {{ $loop->first ? 'bg-white text-white hover:text-black font-bold' : 'bg-blue-dark text-white hover:font-super-bold'}}" href="{{action([\App\Http\Controllers\Docs\DocsController::class, 'repository'], [$repository->slug, $alias->slug])}}">
                        {{ $alias->slug }}
                    </a>
                </span>
            @endforeach
        </div>
        <div class="flex items-center justify-between mt-4">
            <div class="flex justify-between">
                <a href="#" class="flex items-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" class="mr-2"><path fill="white" d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                    <h1 class="font-bold text-white hover:underline"> View source code</h1>
                </a>
            </div>
            <div class="flex justify-between items-center">
                <span class="mx-2">{{ svg('icons/star') }}</span>
                <span> {{ $githubRepositories->where('name', $repository->slug)->first()->stars }}</span>
            </div>
        </div>
    </div>

</div>
