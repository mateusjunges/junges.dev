<?php
/**
 * @var \Illuminate\Support\Collection<\App\Modules\Advertising\Models\Sponsor> $sponsors
 * @see \App\Modules\Advertising\View\Composers\SponsorsComposer
 * @see \App\Providers\ViewServiceProvider
 */
?>

@if(! $sponsors->isEmpty())
    <div class="flex flex-col justify-start items-center rounded-md">
        <p class="font-bold text-center py-8">
            Sponsors
        </p>

        @foreach($sponsors as $sponsor)
            <div class="flex rounded">
                <a href="{{ $sponsor->website }}" target="_blank" rel="noopener noreferrer" class="px-8 py-4">
                    <div class="w-48 object-fit object-center">
                        <img src="{{ $sponsor->getLogoUrlForHtml() }}" alt="{{ $sponsor->alt_text }}">
                    </div>
                </a>
            </div>
        @endforeach

        <div class="w-48 py-8">
            <a href="https://github.com/sponsors/mateusjunges"  class="underline mt-5">
                <button
                    class="py-2 px-3 w-full bg-blue-800 rounded mb-8 text-white hover:underline">
                    Your logo here?
                </button>
            </a>
        </div>
    </div>
@endif
