<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

  
public function userMessages()
{
    // Vérifie que l'utilisateur est bien connecté
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à vos messages.');
    }   $messages = Contact::where('user_id', Auth::id())->latest()->paginate(10);

    return view('dashboard.messages', compact('messages'));

}
public function adminMessages()
{
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403);
    }

    $messages = Contact::latest()->paginate(20);

    return view('dashboard.messages', compact('messages'));
}
public function show(Contact $contact)
{
    return view('contact.show', compact('contact'));
}
public function contactform()
{
    $user = auth()->user();
    $isAdmin = $user && $user->role === 'admin';

    if ($isAdmin) {
        // Côté admin : récupérer tous les utilisateurs avec leurs coordonnées
        $coordonnees = \App\Models\User::paginate(10); // ou un scope si tu veux filtrer
        $currentUser = null;
    } else {
        // Côté utilisateur : afficher ses propres coordonnées
        $coordonnees = null;
        $currentUser = $user;
    }

    return view('contact', [
        'isAdmin' => $isAdmin,
        'coordonnees' => $coordonnees,
        'user' => $currentUser,
    ]);
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

    return redirect()->route('contact.form')->with([
        'success' => 'Votre message a bien été envoyé.',
        'contact_id' => $contact->id,
    ]);
}
    // Accessible uniquement aux admins
   
}