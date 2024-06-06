<?php declare(strict_types=1);

namespace App\Modules\Products\Requests;

use App\Modules\Products\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CheckoutProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'stripe_product_id' => [
                'bail',
                'required',
                Rule::exists(Product::class, 'stripe_product_id'),
            ],
            'stripe_price_id' => [
                'bail',
                'required',
                Rule::exists(Product::class, 'stripe_price_id')
            ]
        ];
    }
}