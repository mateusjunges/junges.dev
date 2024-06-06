<x-app-layout title="Something went wrong">
    @section('no-banner', true)
    <div class="markup">
        <h1>Something went wrong!</h1>
        <p>
            Something went wrong while booking a {{ $product->name }}. Please, try again later and if this error keeps happening, please reach out via email at
            <a href="mailto:mateus@junges.dev">mateus@junges.dev</a>.
        </p>
        <ul>
            <li><a href="{{ route('home') }}">Back to the home page</a></li>
            <li><a href="{{ route('products.index') }}">View available pairing sessions</a></li>
        </ul>
    </div>
</x-app-layout>
