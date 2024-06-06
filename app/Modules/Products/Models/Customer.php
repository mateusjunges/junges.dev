<?php declare(strict_types=1);

namespace App\Modules\Products\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

/**
 * @property int $id Unique identifier for the object.
 * @property string $name The customer name.
 * @property string $email The customer email.
 * @property Collection<int, PairingSession> $pairingSessions The pairing sessions for this customer.
 * @property \Illuminate\Support\Carbon $created_at Time at which the object was created. Technical column and should not represent any domain information.
 * @property \Illuminate\Support\Carbon $updated_at Time at which the object was last time updated. Technical column and should not represent any domain information.
 */
final class Customer extends Model
{
    use Billable;
    use Notifiable;

    /** @var string $table */
    protected $table = 'customers';

    /** @var list<string> $fillable */
    protected $fillable = [
        'name',
        'email',
    ];

    public function pairingSessions(): HasMany
    {
        return $this->hasMany(PairingSession::class, 'customer_id');
    }
}