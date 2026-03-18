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

    // Messages
    $messages = Message::where('user_id', $user->id)
        ->latest()
        ->paginate(10);

    // Coordonnées
    $coordonnees = $user->coordonnee ?? null;

    // Devis
    $devis = Devis::where('user_id', $user->id)
        ->latest()
        ->paginate(10);

    // Rendez-vous
    $rendezvous = Rendezvous::where('user_id', $user->id)
        ->latest()
        ->get();

    // Admin ?
    $admin = $user->role === 'Admin';

    // Propositions RDV
    $service = new RendezvousService();
    $propositions = $service->genererPropositions(
        $coordonnees->rue ?? '',
        $coordonnees->code_postal ?? '',
        $coordonnees->ville ?? 'Nice',
        2
    );

    return view('Admin.dashboard_user', compact(
        'user',
        'messages',
        'coordonnees',
        'devis',
        'rendezvous',
        'admin',
        'propositions'
    ));
}

}

