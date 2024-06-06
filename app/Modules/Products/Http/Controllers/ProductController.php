<?php declare(strict_types=1);

namespace App\Modules\Products\Http\Controllers;

use App\Modules\Products\Models\Product;
use Illuminate\Contracts\View\View;

final class ProductController
{
    public function index(): View
    {
        $thirtyMinutesSession = Product::thirtyMinutesSession();
        $oneHourSession = Product::oneHourSession();

        return view('front.products.index', [
            'thirtyMinutesSession' => $thirtyMinutesSession,
            'oneHourSession' => $oneHourSession,
        ]);
    }

    public function show(Product $product): View
    {
        return view('front.products.show', ['product' => $product]);
    }
}