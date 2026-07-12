<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roleId)
    {
        if (!auth()->check()) {
            return redirect()->route('registration.sign-in');
        }

        if (auth()->user()->role_id != $roleId) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}