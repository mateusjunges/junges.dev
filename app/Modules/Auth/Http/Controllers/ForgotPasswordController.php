<?php declare(strict_types=1);

namespace App\Modules\Auth\Http\Controllers;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Validation\ValidatesRequests;

final class ForgotPasswordController
{
    use ValidatesRequests, SendsPasswordResetEmails;
}
