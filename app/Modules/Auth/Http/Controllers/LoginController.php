<?php declare(strict_types=1);

namespace App\Modules\Auth\Http\Controllers;

use App\Modules\Blog\Http\Controllers\Links\IndexController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;

final class LoginController
{
    use ValidatesRequests, AuthenticatesUsers;

    public function redirectPath(): string
    {
        return action(IndexController::class);
    }
}
