<?php declare(strict_types=1);

namespace App\Modules\Products\Http\Controllers;

use App\Modules\Products\Models\Product;

final class ThankYouController
{
    public function __invoke(Product $product)
    {
        return view('front.thanks', ['product' => $product]);
    }
}