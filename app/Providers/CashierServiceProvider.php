<?php declare(strict_types=1);

namespace App\Providers;

use App\Modules\Auth\Models\User;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Cashier;

final class CashierServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Cashier::useCustomerModel(Billable::class);
    }
}