<?php declare(strict_types=1);

namespace App\Modules\Products\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id Unique identifier for the object.
 * @property int $product_id The pairing session bought.
 * @property int $customer_id The id of the person who bought the pairing session.
 * @property Carbon $paid_at The datetime this pairing session was paid.
 * @property Carbon $scheduled_to The datetime this pairing session is scheduled to happen.
 * @property Customer $customer The customer who bought this pairing session.
 * @property Product $product The product associated with this pairing session.
 * @property \Illuminate\Support\Carbon $created_at Time at which the object was created. Technical column and should not represent any domain information.
 * @property \Illuminate\Support\Carbon $updated_at Time at which the object was last time updated. Technical column and should not represent any domain information.
 */
final class PairingSession extends Model
{
    /** @var string $table */
    protected $table = 'pairing_sessions';

    /** @var list<string> $fillable */
    protected $fillable = [
        'product_id',
        'customer_id',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'scheduled_to' => 'datetime',
            'paid_at' => 'datetime',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function markAsPaid(): void
    {
        $this->paid_at = now();
        $this->save();
    }
}