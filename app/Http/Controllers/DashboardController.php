<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\User;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Devis;
use App\Models\RendezVous;
use App\Models\Coordonnee;
use App\Models\Diagnostic;
use App\Services\RendezvousService;

class DashboardController extends Controller
{

public function index()
{
    $user = Auth::user();

    $messages = Message::where('user_id', $user->id)->latest()->paginate(10);
    $coordonnees = $user->coordonnee ?? null;
    $devis = Devis::where('user_id', $user->id)->latest()->paginate(10);
    $admin = $user->role === 'Admin';
    $rendezvous = Rendezvous::where('user_id', $user->id)->latest()->get();
        // ⚡ Charger les notifications (exemple : les 5 dernières)
    $latestNotifications = Notification::latest()->take(5)->get();



    

        // Utiliser la ville de l’utilisateur
        $zone = $coordonnees->ville ?? 'Nice'; 
        $travailHeure = 2; // durée par défaut
        $service = new RendezvousService();


        $propositions = $service->genererPropositions($zone, $travailHeure);
    

    return view('Admin.dashboard_user', compact(
        'messages','coordonnees','devis','user','admin','rendezvous','latestNotifications'
    ));
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
    $user = User::findOrFail($id);

    $messages = Message::where('user_id', $user->id)->latest()->paginate(10);
    $coordonnees = $user->coordonnee ?? null;
    $devis = Devis::where('user_id', $user->id)->latest()->paginate(10);
    $rendezvous = Rendezvous::where('user_id', $user->id)->latest()->get();
    $admin = $user->role === 'Admin';

    // ⚡ Toujours définir $propositions
    $propositions = [];

    if ($rendezvous->isEmpty()) {
        $service = new RendezvousService();

        // Utiliser la ville de l’utilisateur (ou coordonnees)
        $zone = $coordonnees->ville ?? 'Nice';
        $travailHeure = 2; // durée par défaut

        $propositions = $service->genererPropositions($zone, $travailHeure);
    }

    return view('Admin.dashboard_user', compact(
        'user','messages','coordonnees','devis','rendezvous','admin','propositions'
    ));
}

    /**
     * Vue du tableau de bord Admin
     */// en haut

public function AdminDashboard()
{
    $admin = Auth::user();

    if (!$admin || $admin->role !== 'Admin') {
        abort(403, 'Accès réservé aux Administrateurs');
    }

    // ⚠️ Ici tu dois définir $ $coordonnees = $admin->coordonnee; 
 $coordonnees = $admin->coordonnee; 
    $devis = Devis::paginate(10);
    $rendezvous = RendezVous::all();
    $messages = Contact::with('user')->latest()->paginate(10);
    $devisList = Devis::with('user')->latest()->paginate(10);

    $latestNotifications = $admin->notifications()
        ->latest()
        ->take(5)
        ->get();
 // Récupérer les rendez-vous bloqués
    $rendezvousBloques = Rendezvous::where('bloque', true)
        ->with('user') // pour charger les infos utilisateur
        ->latest()
        ->paginate(10);


    $unreadCount = $admin->notifications()->unread()->count();

    return view('Admin.dashboard_Admin', [
        'admin' => $admin,
        'user' => $admin,
        'coordonnees' => $coordonnees,   // ✅ ajouté
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
    

    if ($user->id != $id && $user->role !== 'Admin') {
        abort(403, 'Accès interdit.');
    }

    return view('Admin.dashboard_user', ['user' => $user]);
}
public function dashboardRoute()
{
    $user = auth()->user();

    $coordonnees = $user->coordonnees;
    $messages = $user->messages()->latest()->paginate(10);
    $devis = $user->role === 'Admin'
        ? Devis::latest()->paginate(10)
        : $user->devis()->latest()->paginate(10);

    $admin = $user->role === 'Admin';
    $notifications = app(NotificationController::class)->latest();
    $rendezvous = collect(); // collection vide pour éviter l'erreur

   

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