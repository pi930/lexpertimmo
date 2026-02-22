<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle($request, Closure $next)
    {
        // Vérifie que l'utilisateur est connecté et admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Accès refusé');
        }

        return $next($request);
    }
}

