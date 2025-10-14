<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Coordonnee;
use App\Models\Contact;
use App\Models\Devis;
use App\Models\RendezVous;

class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.dashboard');
    }
public function showUser($id)
{
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403);
    }

    $user = User::with(['coordonnee', 'contacts', 'devis', 'rendezvous'])->findOrFail($id);
    $coordonnees = Coordonnee::where('user_id', $id)->first();
    $messages = Contact::where('user_id', $id)->get();
    $devis = Devis::where('user_id', $id)->get();
    $rendezvous = RendezVous::where('user_id', $id)->get();

    return view('admin.dashboard_user', compact('user', 'coordonnees', 'messages', 'devis', 'rendezvous'));
}
}
