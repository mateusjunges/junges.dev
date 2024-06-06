<?php declare(strict_types=1);

namespace App\Modules\Products\Models;

use App\Concerns\HasSlug;
use App\Contracts\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id Unique identifier for the object.
 * @property string $stripe_product_id The stripe product id.
 * @property string $stripe_price_id The stripe price id.
 * @property string $stripe_price_lookup_key The lookup key for this product price.
 * @property int $price The product price in cents.
 * @property string $price_currency The price currency.
 * @property string price_currency_symbol The price currency symbol.
 * @property string $name The product name.
 * @property string $slug The product slug.
 * @property string $description The product description.
 * @property \Illuminate\Support\Carbon $created_at Time at which the object was created. Technical column and should not represent any domain information.
 * @property \Illuminate\Support\Carbon $updated_at Time at which the object was last time updated. Technical column and should not represent any domain information.
 */
final class Product extends Model implements Sluggable
{
    use HasSlug;

    /** @var list<string> $fillable */
    protected $fillable = [
        'stripe_product_id',
        'stripe_price_id',
        'stripe_price_lookup_key',
        'name',
        'slug',
        'description',
        'price',
        'price_currency',
    ];

    public static function thirtyMinutesSession(): self
    {
        $product = self::query()->where('slug', '30-minutes-pairing-session')->first();
        assert($product instanceof Product);

        return $product;
    }

    public static function oneHourSession(): self
    {
        $product = self::query()->where('slug', '1-hour-pairing-session')->first();
        assert($product instanceof Product);

        return $product;
    }

    public function getFormattedPrice(int $decimals = 0): string
    {
        return sprintf(
            '%s%s',
            $this->price_currency_symbol,
            number_format($this->price / 100, $decimals, ','),
        );
    }

    public function getSluggableValue(): string
    {
        return $this->name;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
}