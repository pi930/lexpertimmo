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
public function redirect()
{
    $user = Auth::user();

    return redirect()->route($user->dashboardRoute(), ['id' => $user->id]);
}
// si relation définie
public function showUserDashboard($id)
{
    $authUser = Auth::user();

    if ($authUser->id != $id) {
        abort(403, 'Accès interdit');
    }

    $user = User::findOrFail($id);
    $coordonnees = $user->coordonnees; // ou Coordonnees::where('user_id', $id)->first()
    $messages = Contact::where('user_id', $id)->latest()->get();
    $devis = Devis::where('user_id', $id)->latest()->paginate(10);
    $rendezvous = $user->rendezvous ?? [];
    $IsAdmin = false;

    return view('IsAdmin.dashboard_user', compact(
        'user',
        'coordonnees',
        'messages',
        'devis',
        'rendezvous',
        'IsAdmin'
    ));

}

    /**
     * Vue du tableau de bord IsAdmin
     */
public function IsAdminDashboard()
{
    $IsAdmin = Auth::user();

    if (!$IsAdmin || $IsAdmin->role !== 'IsAdmin') {
        abort(403, 'Accès réservé aux IsAdministrateurs');
    }

    $users = User::with('coordonnee')->paginate(10);
    $devis = Devis::all();
    $rendezvous = RendezVous::all();
    $messages = Contact::with('user')->latest()->get();

    $latestNotifications = $IsAdmin->notifications()
        ->latest()
        ->take(5)
        ->get();

    $unreadCount = $IsAdmin->notifications()->unread()->count();

    return view('IsAdmin.dashboard_IsAdmin', [
        'IsAdmin' => $IsAdmin,
        'users' => $users,
        'user' => $IsAdmin,
        'coordonnees' => $IsAdmin->coordonnee ?? null,
        'messages' => $messages,
        'devis' => $devis,
        'rendezvous' => $rendezvous,
        'latestNotifications' => $latestNotifications,
        'unreadCount' => $unreadCount,
        'IsAdmin' => true,
    ]);
} 

    /**
     * Vue partagée des coordonnées
     */
    public function coordonnees()
    {
        $user = Auth::user();
        $IsAdmin = $user->role === 'IsAdmin';

        $coordonnees = $IsAdmin
            ? Contact::with('user')->paginate(10)
            : Contact::where('user_id', $user->id)->latest()->get();

    return view('dashboard.coordonnees', compact('user', 'IsAdmin', 'coordonnees'));
    }
public function dashboard($id)
{
    $user = Auth::user();

    if ($user->id != $id && $user->role !== 'IsAdmin') {
        abort(403, 'Accès interdit.');
    }

    return view('IsAdmin.dashboard_user', ['user' => $user]);
}
}