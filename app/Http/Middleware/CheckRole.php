<?php 
use Illuminate\Support\Facades\Auth;

// middleware/CheckRole.php
public function handle($request, Closure $next, $role)
{
    if (Auth::user()->role !== $role) {
        abort(403);
    }

    return $next($request);
}
