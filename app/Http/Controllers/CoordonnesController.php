<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Coordonnee;
use App\Models\User;

class CoordonneesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isAdmin = $user->role === 'admin';

        if ($isAdmin) {
            $coordonnees = Coordonnee::with('user')->paginate(10);
        } else {
            $coordonnees = null;
        }

        return view('dashboard.coordonnees', [
            'isAdmin' => $isAdmin,
            'coordonnees' => $coordonnees,
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'rue' => 'required|string|max:255',
            'code_postal' => 'required|string|max:10',
            'ville' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $coord = new Coordonnee();
        $coord->fill($validated);
        $coord->user_id = Auth::id();
        $coord->save();
{
    // ... traitement du formulaire ...

    if (Auth::check()) {
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    } else {
        return redirect()->route('register');
    }
}

        return redirect()->route('coordonnees.index')->with('success', 'Coordonnées enregistrées.');
    }
}