<x-app-layout title="{{ $product->name }}">
    @section('no-banner', true)
    <div class="markup">
        <h1>{{ $product->name }}</h1>

        <p>{{ $product->description }} I'll reach out to you to schedule our session.</p>
    </div>

    <div class="mt-5">
        <form class="mt-2" action="{{ route('products.checkout', $product) }}" method="post">
            @csrf
            <input type="hidden" name="stripe_price_id" value="{{ $product->stripe_price_id }}">
            <input type="hidden" name="stripe_product_id" value="{{ $product->stripe_product_id }}">
            <div>
                <label for="name" class="sr-only">Your name</label>
                <input type="text" id="name" name="name" placeholder="Your name *" required autofocus>
            </div>
            <div class="mt-2">
                <label for="email" class="sr-only">Your email</label>
                <input type="text" id="email" placeholder="Your email *" name="email" required>
            </div>
            <button
                    type="submit"
                    class="mt-4 py-2 px-3 mx-auto button bg-blue-darker border-b-gray-900 hover:underline rounded mb-8 text-white">
                Book now for {{ $product->getFormattedPrice() }}
            </button>
        </form>
    </div>
</x-app-layout>
