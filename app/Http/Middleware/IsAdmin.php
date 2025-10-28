<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Si l'utilisateur n'est pas connecté ou n'est pas admin
        if (!$user || $user->role !== 'admin') {
            // Option 1 : redirection vers une page publique
            return redirect()->route('home');

            // Option 2 : ou renvoyer une erreur 403
            // abort(403, 'Accès réservé aux administrateurs');
        }

        return $next($request);
    }
}