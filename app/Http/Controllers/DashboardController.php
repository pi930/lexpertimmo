<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Devis;
use App\Models\RendezVous;
use App\Models\Diagnostic;

class DashboardController extends Controller
{

    public function index()
    {
          $user = Auth::user();

    $messages = Message::where('user_id', $user->id)->latest()->paginate(10);
    $coordonnees = $user->coordonnees ?? null;
    $devis = Devis::where('user_id', $user->id)->latest()->paginate(10);
    $rendezvous = Rendezvous::where('user_id', $user->id)->latest()->get();
   // $admin = $user->role === 'Admin';
     // Notifications uniquement pour Admin
    $latestNotifications = [];
    if ($user->role === 'Admin') {
        $latestNotifications = $user->notifications()
            ->latest()
            ->take(5)
            ->get();
    }


    return view('Admin.dashboard_user', compact(
        'user',
        'messages',
        'coordonnees',
        'devis',
        'rendezvous',
        'latestNotifications' // ✅ ajouté    ));
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
    $authUser = Auth::user();

    if ($authUser->id != $id && $authUser->role !== 'Admin') {
        abort(403, 'Accès interdit');
    }

    $user = User::findOrFail($id);
    $coordonnees = $user->coordonnees; // ou Coordonnees::where('user_id', $id)->first()
    $messages = Contact::where('user_id', $id)->latest()->paginate(10);
    $devis = Devis::where('user_id', $id)->latest()->paginate(10);
    $rendezvous = $user->rendezvous ?? [];
    $admin = $authUser->role === 'Admin';


    return view('Admin.dashboard_user', compact(
        'user',
        'coordonnees',
        'messages',
        'devis',
        'rendezvous',
        'admin'
    ));

}

    /**
     * Vue du tableau de bord Admin
     */

public function AdminDashboard()
{
    $admin = Auth::user(); // récupère l'utilisateur connecté

    if (!$admin || $admin->role !== 'Admin') {
        abort(403, 'Accès réservé aux Administrateurs');
    }

    $users = User::with('coordonnees')->paginate(10);
    $devis = Devis::paginate(10); // 10 éléments par page
    $rendezvous = RendezVous::all();
    $messages = Contact::with('user')->latest()->paginate(10);

    $latestNotifications = $admin->notifications()
        ->latest()
        ->take(5)
        ->get();

    $unreadCount = $admin->notifications()->unread()->count();

    return view('Admin.dashboard_Admin', [
        'admin' => $admin,
        'users' => $users,
        'user' => $admin,
        'coordonnees' => $admin->coordonnee ?? null,
        'devis' => $devis,
        'rendezvous' => $rendezvous,
        'messages' => $messages,
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
        $admin= $user->role === 'admin';

        $coordonnees = $admin
            ? Contact::with('user')->paginate(10)
            : Contact::where('user_id', $user->id)->latest()->get();

    return view('dashboard.coordonnees', compact('user', 'admin', 'coordonnees'));
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