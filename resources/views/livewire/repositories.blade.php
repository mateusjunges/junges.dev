<div class="bg-white text-black font-inter">
    @if($this->filterable)
        <div class="wrap flex justify-start mb-8">
        </div>
        <div class="">
            <div class="flex flex-col justify-between mb-8 items-center md:flex-row w-full">
                <input
                        type="search"
                        class="form-input px-4 focus:border-2 focus:border-blue-dark w-full md:w-2/3 bg-white text-black"
                        placeholder="Search packages..."
                        wire:model="search"
                >
                <div class="mt-6 md:mt-0 md:ml-6 flex flex-row justify-between items-center w-full md:w-1/3 md:justify-end bg-simple">
                    <label for="sort" class="text-gray mr-2">
                        Sort
                    </label>
                    <div class="select w-full bg-white">
                        <select name="sort" wire:model="sort" class="bg-white text-black">
                            <option value="-downloads">by downloads</option>
                            <option value="name">by name</option>
                            <option value="-stars">by popularity</option>
                        </select>
                        <span class="select-arrow text-black focus:border-2 focus:border-blue-dark">
                        {{ __svg('icons/far-angle-down') }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="border-white">
        <div>
            @foreach($repositories as $repository)
                <div class="cells" style="grid-template-columns: 3fr 3fr 1fr">
                    <div class="cell-l">
                        <div>
                            <a class="font-super-bold text-black font-inter link-underline"
                               href="{{ $repository->url }}" target="_blank"
                               rel="nofollow noreferrer noopener">
                                {{ $repository->name }}
                            </a>
                        </div>
                        <div class="text-xs mt-2 text-black">
                            @if($repository->language)
                                <span class="font-bold">
                                    {{ $repository->language }}
                                    <span class="char-separator">•</span>
                                </span>
                            @endif
                            @if($repository->downloads)
                                <span class="font-super-bold">
                                    {{ number_format($repository->downloads, 0, '.', ' ') }}
                                    <span class="icon fill-current text-black"
                                          style="transform: translateY(-1px)">{{ __svg('icons/fal-arrow-to-bottom') }}</span>
                                    <span class="char-separator">•</span>
                                </span>
                            @endif
                            {{ number_format($repository->stars, 0, '.', ' ') }} <span
                                    class="icon fill-current text-gray"
                                    style="transform: translateY(-2px)">{{ __svg('icons/fal-star') }}</span>
                            @if($repository->has_issues)
                                <a href="{{ $repository->issues_url }}" target="_blank"
                                   rel="nofollow noreferrer noopener"
                                   class="text-green-dark rounded-full px-2 ml-2">
                                    easy issues
                                </a>
                            @endif
                            @if($repository->is_new)
                                <span class="bg-gold-lightest text-gold-darkest rounded-full px-2 ml-2">
                                    new
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="cell">
                        {{ $repository->description }}
                        <div class="text-xs mt-2 text-black font-light">
                            @foreach($repository->topics as $topic)
                                <span>
                                    {{ $topic }}
                                    @unless($loop->last)
                                        <span class="char-separator">•</span>
                                    @endunless
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="cell-r mt-4 flex flex-col justify-center | md:mt-0 md:grid-text-right">
                        @if($repository->blogpost_url)
                            <a href="{{ $repository->blogpost_url }}" target="_blank"
                               rel="nofollow noreferrer noopener"
                               class="link-underline link-gray text-xs">
                                Introduction
                            </a>
                        @endif
                        @if($repository->documentation_url)
                            <a href="{{ $repository->documentation_url }}" target="_blank"
                               rel="nofollow noreferrer noopener"
                               class="link-underline text-black text-xs">
                                Documentation
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        @unless(count($repositories))
            <p class="mt-6 mb-16 text-lg text-black font-light">
                Unfortunately, the package you are looking for does not exist (yet).
            </p>
        @endunless
    </div>
</div>
