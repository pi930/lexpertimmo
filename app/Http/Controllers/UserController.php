<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Formulaire admin -> redirection vers le dashboard de l'utilisateur
    public function findUser(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'email' => 'required|email',
        ]);

        $user = User::where('nom', $request->nom)
                    ->where('email', $request->email)
                    ->first();

        if (!$user) {
            return back()->with('error', 'Utilisateur introuvable');
        }

        // MÉTHODE 1 : on va DIRECTEMENT sur le dashboard utilisateur
        return redirect()->route('user.dashboard', ['id' => $user->id]);

    }

    // Dashboard utilisateur (spécifique à un user)
    public function dashboardUser($id)
    {
        $user = User::findOrFail($id);

        // Ici tu charges tout ce qui concerne CE user
        // ex: coordonnees, messages, devis, rendezvous, etc.
        // $coordonnees = ...
        // $messages = ...
        // etc.

        return view('Admin.dashboard_user', compact('user'));
    }
}

