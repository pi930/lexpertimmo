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

public function send(Request $request)
{
  $validated = $request->validate([
    'nom' => 'required|string|max:255',
    'email' => 'required|email',
    'telephone' => 'nullable|string|max:20',
    'sujet' => 'nullable|string|max:255',
    'message' => 'required|string|max:2000',
    'rue' => 'required|string|max:255',
    'ville' => 'required|string|max:255',
    'code_postal' => 'required|string|max:10',
    'pays' => 'required|string',
]);

    // Ajout de l'ID utilisateur si connecté
    if (Auth::check()) {

        // Enregistrement du message
        Contact::create($validated);

        // Redirection selon le rôle
        return 
            redirect('/dashboard')->with('success', 'Message enregistré. Redirection vers votre tableau de bord.');
    }

    // Si non connecté : enregistrement sans user_id
    Contact::create($validated);
    return redirect()->route('login')->with('success', 'Message enregistré. Veuillez vous connecter pour accéder à votre espace.');
}   
public function userMessages()
{
    // Vérifie que l'utilisateur est bien connecté
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à vos messages.');
    }

    // Récupère les messages liés à l'utilisateur
    $messages = Contact::where('user_id', Auth::id())
                       ->latest()
                       ->paginate(10);

    // Affiche la vue avec les messages
    return view('dashboard.messages', [
        'messages' => $messages,
    ]);
}
public function adminMessages()
{
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403);
    }

    $messages = Contact::latest()->paginate(20);

    return view('admin.contact.index', compact('messages'));
}
    // Accessible uniquement aux admins
   
}