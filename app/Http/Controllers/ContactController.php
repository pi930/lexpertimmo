<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\User;      // ✅ importer ton modèle User
use App\Models\Notification;
use App\Models\Devis;
use App\Models\Rendezvous;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

  
public function userMessages()
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à vos messages.');
    }

    $user = Auth::user();
    $messages = Contact::where('user_id', $user->id)->latest()->paginate(10);

    return view('dashboard.messages', [
        'messages' => $messages,
        'user' => $user,
        'admin' => false,
    ]);
}

public function AdminMessages()
{
    if (!Auth::check() || Auth::user()->role !== 'Admin') {
        abort(403);
    }

    $user = Auth::user();
    $messages = Contact::latest()->paginate(20);

    return view('dashboard.messages', [
        'messages' => $messages,
        'user' => $user,
        'admin' => true,
    ]);
}

public function contactform()
{
    $user = auth()->user();
    $admin= $user && $user->role === 'Admin';

    if ($admin) {
        // Côté Admin: récupérer tous les utilisateurs avec leurs coordonnées
        $coordonnees = \App\Models\User::paginate(10); // ou un scope si tu veux filtrer
        $currentUser = null;
    } else {
        // Côté utilisateur : afficher ses propres coordonnées
        $coordonnees = null;
        $currentUser = $user;
    }

    return view('contact', [
        'admin' => $admin,
        'coordonnees' => $coordonnees,
        'user' => $currentUser,
    ]);
}

public function showUserMessages($id)
{
    $user = User::findOrFail($id);
    $messages = Contact::where('user_id', $id)->paginate(10);
    $coordonnees = $user->coordonnees;
    $devis = $user->devis()->paginate(10);   // ✅ pagination ici
    $rendezvous = $user->rendezvous;
    $latestNotifications = Notification::latest()->take(5)->get();
   $devisList = Devis::where('user_id', $user->id)
                  ->with('user')
                  ->latest()
                  ->paginate(10);
     $rendezvousBloques = Rendezvous::where('bloque', 1)->get();
    $propositions = Rendezvous::where('user_id', $id)->get();

   if(auth()->user()->role === 'Admin') {
        // Vue admin
        return view('Admin.dashboard_Admin', compact('user', 'messages', 'coordonnees', 'devis', 'rendezvous','latestNotifications','devisList',"rendezvousBloques",'propositions'))
               ->with('admin', true);
    } else {
        // Vue utilisateur
        return view('Admin.dashboard_user', compact('user', 'messages', 'coordonnees', 'devis', 'rendezvous','latestNotifications','devisList',"rendezvousBloques","propositions"))

               ->with('admin', false);
    }
}
public function replyForm($id)
{
    $message = Contact::findOrFail($id);
    $user = User::find($message->user_id);
    $admin = Auth::user();

    return view('contact.reply', compact('message', 'user', 'admin'));
}
public function sendReply(Request $request, $id)
{
    $request->validate([
        'reponse' => 'required|string',
    ]);

    $message = Contact::findOrFail($id);
    $message->reponse = $request->reponse;
    $message->save();

    return redirect()->route('user.contact', ['id' => $message->user_id])
        ->with('success', 'Réponse envoyée avec succès.');
}
/**
 * Formulaire d'édition du message
 */
public function edit($id)
{
    $contact = Contact::findOrFail($id);

    // Récupérer les dernières notifications
    $latestNotifications = Notification::latest()->take(5)->get();

    // Vérification des droits
    if ($contact->user_id !== Auth::id() && Auth::user()->role !== 'Admin') {
        abort(403, 'Accès interdit');
    }

    return view('contact.edit', compact('contact', 'latestNotifications'));
}

/**
 * Mise à jour du message
 */
public function update(Request $request, $id)
{
    $contact = Contact::findOrFail($id);

    if ($contact->user_id !== Auth::id() && Auth::user()->role !== 'Admin') {
        abort(403, 'Accès interdit');
    }

    $validated = $request->validate([
        'sujet'   => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    $contact->update($validated);

    return redirect()->route('dashboard')
        ->with('success', 'Message mis à jour avec succès.');
}
public function store(Request $request)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'rue' => 'required|string|max:255',
        'ville' => 'required|string|max:255',
        'code_postal' => 'required|string|max:20',
        'pays' => 'required|string|max:100',
        'email' => 'required|email|max:255',
        'telephone' => 'nullable|string|max:20',
        'sujet' => 'nullable|string|max:255',
        'message' => 'nullable|string',
    ]);

    if (auth()->check()) {
        $validated['user_id'] = auth()->id();
    }

    $contact = Contact::create($validated);

   return redirect()->route('dashboard')->with([
    'success' => 'Votre message a bien été envoyé.',
    'contact_id' => $contact->id,
]);
}


public function show($id)
{
    $contact = Contact::where('user_id', $id)->firstOrFail();

    return view('contact', compact('contact'));
}
   
public function destroy($id)
{
    $contact = Contact::findOrFail($id);

    if ($contact->user_id !== Auth::id() && Auth::user()->role !== 'Admin') {
        abort(403);
    }

    $contact->delete();

    return redirect()->back()->with('success', 'Message supprimé avec succès.');
}
}