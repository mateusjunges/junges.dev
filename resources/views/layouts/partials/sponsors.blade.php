<?php
/**
 * @var \Illuminate\Support\Collection<App\Modules\Adverstisement\Models\Sponsor> $sponsors
 * @see \App\Modules\Adverstisement\View\Composers\SponsorsComposer
 * @see \App\Modules\Adverstisement\Providers\AdvertisementServiceProvider
 */
$class ??= [];
$sponsorClass ??= [];
?>

<div class="@if($sponsors->isEmpty()) hidden @endif flex flex-col justify-center h-full items-center {{ $bg }} min-h-full rounded @foreach($class as $c) {{ $c }} @endforeach">

    <p class="font-bold text-center py-8">
        Sponsors
    </p>
    <div
        class="flex h-full items-center {{ $bg }} min-h-full rounded @foreach($sponsorClass as $sc) {{ $sc }} @endforeach">
        @foreach($sponsors as $sponsor)
            <a href="{{ $sponsor->website }}" target="_blank" rel="noopener noreferrer" class="px-8 py-4">
                <div class="w-48 object-fit object-center h-auto">
                    <img src="{{ $sponsor->getLogoUrl() }}" alt="{{ $sponsor->name }}">
                </div>
            </a>
        @endforeach
    </div>
    <div class="w-48 h-auto">
        <a href="https://github.com/sponsors/mateusjunges"  class="underline mt-5">
            <button
                class="py-2 px-3 w-full bg-blue-800 rounded mb-8 text-white hover:underline">
                Your logo here?
            </button>
        </a>
    </div>
</div>
