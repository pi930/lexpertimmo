<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Contact;
use App\Models\Devis;
use App\Models\RendezVous;
use App\Models\Diagnostic;

class DashboardController extends Controller
{
    /**
     * Redirection principale après login
     */
    public function index()
    {
        $user = Auth::user();

        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard_admin')
            : redirect()->route('admin.dashboard_user', ['id' => $user->id]);
    }

    /**
     * Vue du tableau de bord utilisateur (vue par l'admin)
     */
    public function showUserDashboard($id)
    {
        $admin = Auth::user();

        if (!$admin || $admin->role !== 'admin') {
            abort(403, 'Accès réservé aux administrateurs');
        }

        $user = User::with(['coordonnee', 'contacts', 'devis', 'rendezvous'])->findOrFail($id);

        return view('admin.dashboard_user', [
            'user' => $user,
            'coordonnees' => $user->coordonnee ?? $user,
            'messages' => $user->contacts,
            'devis' => $user->devis,
            'rendezvous' => $user->rendezvous,
        ]);
    }

    /**
     * Vue du tableau de bord admin
     */
    public function adminDashboard()
    {
        $admin = Auth::user();



        if (!$admin || $admin->role !== 'admin') {
            abort(403, 'Accès réservé aux administrateurs');
        }
 

        $users = User::with('coordonnee')->paginate(10);
        $devis = Devis::all(); // ou une requête filtrée selon ton besoin
        $rendezvous = RendezVous::all(); // si tu utilises aussi $rendezvous
                  $latestNotifications = $admin->notifications()
    ->latest()
    ->take(5)
    ->get();

$unreadCount = $admin->notifications()->unread()->count();



        return view('admin.dashboard_admin', [
            'admin' => $admin,
            'users' => $users,
            'user' => $admin,
            'coordonnees' => $admin->coordonnee ?? $admin,
            'messages' => $admin->contacts ?? [],
             'devis' => $devis,
            'rendezvous' => $rendezvous,
            'latestNotifications' => $latestNotifications,
            'unreadCount' => $unreadCount,


        ]);
    }
    

    /**
     * Vue partagée des coordonnées
     */
    public function coordonnees()
    {
        $user = Auth::user();
        $IsAdmin = $user->role === 'admin';

        $coordonnees = $IsAdmin
            ? Contact::with('user')->paginate(10)
            : Contact::where('user_id', $user->id)->latest()->get();

        return view('dashboard.coordonnees', compact('user', 'isAdmin', 'coordonnees'));
    }
}