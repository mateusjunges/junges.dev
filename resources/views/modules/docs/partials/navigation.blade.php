<nav class="h-full pb-6 md:py-6 md:shadow-light rounded-sm pl-4 pr-4 md:px-4">
    <div class="flex justify-between items-center pb-4 border-b-2 border-gray-lighter py-2 my-2">
        <div class="text-xs font-normal leading-normal select h-12">
            <select name="alias" class="text-lg text-gray-700"
                    onChange="location='/documentation/{{ $repository->slug }}/' + this.options[this.selectedIndex].value">
                @foreach($repository->aliases as $aliasOption)
                    <option value="{{ $aliasOption->slug }}" {{ $page->alias === $aliasOption->slug ? 'selected="selected"' : '' }}>
                        {{ $aliasOption->slug }} ({{ $aliasOption->branch }})
                    </option>
                @endforeach
            </select>
            <span class="select-arrow text-black">
                {{ __svg('icons/far-angle-down') }}
            </span>
        </div>
        <div class="ml-auto pl-2 flex items-center">
            <a class="text-xs underline hover:text-black-500"
               href="{{ $alias->githubUrl }}/blob/{{$alias->branch}}/docs/{{ $page->slug }}.md"
               target="_blank">
                Edit
            </a>
            <a class="ml-2 flex text-xs link-gray"
               href="{{ $alias->githubUrl }}/tree/{{$alias->branch}}"
               target="_blank">
                <span class="w-4 h-4 text-black">
                    {{ __svg('github') }}
                </span>
            </a>
        </div>
    </div>

    <div class="pt-4 ">
        {{--        <input type="search" class="text-xs form-input w-full h-8 py-0 px-2 mb-8" id="algolia-search" placeholder="Search…">--}}
        <ol class="text-xs">
            @foreach($navigation as $key => $section)
                @if ($key !== '_root')
                    <h2 class="title-sm text-sm mb-2">{{ $section['_index']['title'] }}</h2>
                @endif

                <ul class="mb-6 space-y-1 @if($key !== '_root') pl-2 border-l-2 border-gray-lighter border-opacity-75 @endif">
                    @foreach($section['pages'] as $navItem)
                        <li class="leading-snug">
                            <a href="{{ $navItem->url }}"
                               class="@if($page->slug === $navItem->slug) font-bold underline @endif">
                                {{ $navItem->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </ol>
    </div>

</nav>
