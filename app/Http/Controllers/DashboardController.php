<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\User;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Devis;
use App\Models\Rendezvous;
use App\Models\Coordonnee;
use App\Models\Diagnostic;
use App\Services\RendezvousService;

class DashboardController extends Controller
{

public function index()
{
    $user = Auth::user();

    if (strtolower($user->role) === 'admin') {
        return redirect()->route('admin.rendezvous');
    }

    return redirect()->route('user.dashboard', $user->id);
}


    /**
     * Redirection principale après login
     */
public function redirect()
{
    return redirect()->to(Auth::user()->dashboardLink());
}
// si relation définie


public function showUserDashboard($id)
{
    $user = Auth::user();

    // Si c'est un admin → redirection vers dashboard admin
    if (strtolower($user->role) === 'admin') {
        return redirect()->route('admin.rendezvous');
    }

    if ($user->id != $id) {
        abort(403);
    }

    // Reste du code utilisateur...
    $messages = Contact::where('user_id', $user->id)->latest()->paginate(10);
    $coordonnees = $user->coordonnee ?? null;
    $devis = Devis::where('user_id', $user->id)->latest()->paginate(10);
    $rendezvous = Rendezvous::where('user_id', $user->id)->latest()->get();

    $service = new RendezvousService();
    $propositions = $service->genererPropositions(
        $coordonnees->rue ?? '',
        $coordonnees->code_postal ?? '',
        $coordonnees->ville ?? 'Nice',
        2
    );

    // 🔥 AJOUT ESSENTIEL
    $admin = false;

    return view('Admin.dashboard_user', compact(
        'user','messages','coordonnees','devis','rendezvous','propositions','admin'
    ));
}



    /**
     * Vue du tableau de bord Admin
     */// en haut

public function AdminDashboard()
{
    $admin = Auth::user();

    if (strtolower($admin->role) !== 'admin') {
        abort(403);
    }

    // Coordonnées de l’admin
    $coordonnees = $admin->coordonnee;

    // Tous les devis
    $devis = Devis::paginate(10);

    // Tous les rendez-vous
    $rendezvous = Rendezvous::all();

    // ⚡ Messages de contact (admin)
    $messages = Contact::with('user')->latest()->paginate(10);

    // Liste des devis avec relations
    $devisList = Devis::with('user')->latest()->paginate(10);

    // Rendez-vous bloqués
    $rendezvousBloques = Rendezvous::where('bloque', true)
        ->with('user')
        ->latest()
        ->paginate(10);

    // Notifications
    $latestNotifications = $admin->notifications()
        ->latest()
        ->take(5)
        ->get();

    $unreadCount = $admin->notifications()->unread()->count();

    return view('Admin.dashboard_Admin', [
        'admin' => $admin,
        'user' => $admin,
        'coordonnees' => $coordonnees,
        'devis' => $devis,
        'rendezvous' => $rendezvous,
        'messages' => $messages,
        'latestNotifications' => $latestNotifications,
        'unreadCount' => $unreadCount,
        'devisList' => $devisList,
        'rendezvousBloques' => $rendezvousBloques,
    ]);
}





public function dashboard($id)
{
    $user = Auth::user();
    

    if ($user->id != $id && strtolower($user->role) !== 'admin') {
        abort(403, 'Accès interdit.');
    }

    return view('Admin.dashboard_user', ['user' => $user]);
}
public function dashboardRoute()
{
    $user = auth()->user();

    $coordonnees = $user->coordonnees;
    $messages = $user->messages()->latest()->paginate(10);
    $devis = strtolower($user->role) === 'admin'
    ? Devis::latest()->paginate(10)
    : $user->devis()->latest()->paginate(10);
    $admin = strtolower($user->role) === 'admin';
    $notifications = app(NotificationController::class)->latest();
    $rendezvous = Rendezvous::where('user_id', $user->id)
    ->latest()
    ->get();

   

    return view($user->dashboardView(), [
        'user' => $user,
        'coordonnees' => $coordonnees,
        'messages' => $messages,
        'devis' => $devis,
        'admin' => $admin,
        'latestNotifications' => $notifications,
        'rendezvous' => $rendezvous,
        

    ]);
}
}
