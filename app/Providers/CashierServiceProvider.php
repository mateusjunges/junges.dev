<?php declare(strict_types=1);

namespace App\Providers;

use App\Modules\Auth\Models\User;
use Laravel\Cashier\Cashier;

final class CashierServiceProvider
{
    public function boot(): void
    {
        Cashier::useCustomerModel(User::class);
    }
}