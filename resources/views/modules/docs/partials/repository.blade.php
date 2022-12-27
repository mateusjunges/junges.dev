@php
    /** @var \App\Modules\Documentation\Support\Repository $repository */
@endphp

<li class="flex px-2 mb-4 w-full leading-5 text-left break-words lg:w-1/2 md:w-1/2 text-slate-300">
    <div
        class="flex p-4 w-full leading-5 text-left break-words rounded-md bg-gray-100 text-slate-300">
        <div
            class="flex flex-col p-4 w-full leading-5 text-left rounded-md text-slate-300">
            <div class="leading-5 text-left items-center text-slate-300">
                <a href="{{ action([\App\Modules\Documentation\Http\Controllers\DocsController::class, 'repository'], $repository->slug) }}"
                   class="flex items-center">
                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1"
                         width="16" class="text-black mr-1"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M2 2.5A2.5 2.5 0 014.5 0h8.75a.75.75 0 01.75.75v12.5a.75.75 0 01-.75.75h-2.5a.75.75 0 110-1.5h1.75v-2h-8a1 1 0 00-.714 1.7.75.75 0 01-1.072 1.05A2.495 2.495 0 012 11.5v-9zm10.5-1V9h-8c-.356 0-.694.074-1 .208V2.5a1 1 0 011-1h8zM5 12.25v3.25a.25.25 0 00.4.2l1.45-1.087a.25.25 0 01.3 0L8.6 15.7a.25.25 0 00.4-.2v-3.25a.25.25 0 00-.25-.25h-3.5a.25.25 0 00-.25.25z"></path>
                    </svg>
                    <span
                        class="font-semibold leading-5 text-left text-black break-words cursor-pointer"
                        title="{{ $repository->slug }}">
                            mateusjunges/{{ $repository->slug }}
                    </span>
                </a>
            </div>

            <!-- Slogan -->
            <p class="flex-grow flex-shrink-0 mt-2 mb-0 text-xs leading-4 text-left break-words basis-auto text-gray-700">
                {{ optional($repository->aliases->last())->slogan }}
            </p>


            <!-- Available documentation versions -->
            <div
                class="mt-2 text-xs text-gray-700 flex flex-row gap-2 justify-start items-center">
                <p class="text-left">Available Versions:</p>
                <div>
                    @foreach($repository->getSortedAliases() as $alias)
                        <span>
                            <a class="inline-flex items-center underline justify-center px-2 hover:font-super-bold {{ $loop->first ? 'text-black hover:text-black font-bold' : 'text-black hover:font-super-bold'}}"
                               href="{{action([\App\Modules\Documentation\Http\Controllers\DocsController::class, 'repository'], [$repository->slug, $alias->slug])}}">
                                {{ $alias->slug }}
                            </a>
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- statistics -->
            <div
                class="mt-2 mb-0 text-xs leading-4 text-left break-words text-zinc-400 flex flex-row justify-between">
                <!-- Stars -->
                <div class="flex">
                    <a href="{{ $repository->getStargazersUrl() }}"
                       class="inline-block text-xs leading-4 text-left text-gray-700 break-words bg-transparent cursor-pointer flex items-center"
                       style="text-decoration: none; list-style: outside none none;">
                        {{ __svg('icons/github-star') }}
                        {{ $githubRepositories->where('name', $repository->slug)->first()->stars }}
                    </a>

                    <!-- Forks -->
                    @if($githubRepositories->where('name', $repository->slug)->first()->forks !== null || app()->environment('local'))
                        <a
                            href="{{ $repository->getForksUrl() }}"
                            class="flex ml-4 text-xs leading-4 text-left text-gray-700 break-words bg-transparent cursor-pointer items-center">
                            {{ __svg('icons/github-forks') }}
                            {{ $githubRepositories->where('name', $repository->slug)->first()->forks ?? rand(1, 150)}}
                        </a>
                    @endif
                </div>

                <!-- Composer install statistics -->
                <div class="text-right flex text-gray-700">
                    <span class="mr-2">{{ __svg('icons/download') }}</span>
                    <p>{{ $githubRepositories->where('name', $repository->slug)->first()->downloads }}</p>
                </div>
            </div>

        </div>
    </div>
</li>
