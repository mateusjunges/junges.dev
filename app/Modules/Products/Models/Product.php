<?php declare(strict_types=1);

namespace App\Modules\Products\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id Unique identifier for the object.
 * @property string $stripe_product_id The id of this product on stripe
 * @property \Illuminate\Support\Carbon $created_at Time at which the object was created. Technical column and should not represent any domain information.
 * @property \Illuminate\Support\Carbon $updated_at Time at which the object was last time updated. Technical column and should not represent any domain information.
 */
final class Product extends Model
{
    /** @var list<string> $fillable */
    protected $fillable = [
        'stripe_product_id',
    ];

    
}