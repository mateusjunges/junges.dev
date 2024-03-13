<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Modules\Auth\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

final class Admin
{
    public function handle($request, Closure $next, $guard = null)
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        assert($user instanceof User);

        if (! $user->admin) {
            abort(403);
        }

        return $next($request);
    }
}
