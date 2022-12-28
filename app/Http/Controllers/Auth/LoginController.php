<?php

namespace App\Http\Controllers\Auth;

use App\Modules\Blog\Http\Controllers\Links\IndexController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LoginController
{
    use ValidatesRequests, AuthenticatesUsers;

    public function redirectPath()
    {
        return action(IndexController::class);
    }
}
