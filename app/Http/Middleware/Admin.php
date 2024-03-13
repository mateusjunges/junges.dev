<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Modules\Auth\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

final class Admin
{
    public function handle(Request $request, Closure $next, $guard = null): Response
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
