<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'user') {
            return $next($request); // l'utilisateur est 'user', autorisé
        }

        abort(403, 'Unauthorized'); // sinon accès refusé
    }
}
