<x-app-layout title="Pairing session booked!">
    @section('no-banner', true)
    <div class="markup">
        <h1>Pairing session booked!</h1>
        <p>
            Thank you for booking a {{ $product->name }}. I'll reach out via email soon so we can schedule it.
        </p>
        <ul>
            <li><a href="{{ route('home') }}">Back to the home page</a></li>
        </ul>
    </div>
</x-app-layout>
