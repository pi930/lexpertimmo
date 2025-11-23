<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Coordonnee;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

public function store(Request $request)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed|min:8',
        'rue' => 'required|string|max:255',
        'code_postal' => 'required|string|max:20',
        'ville' => 'required|string|max:255',
        'pays' => 'required|string|max:100',
        'phone' => 'required|string|max:20',
    ]);

    $user = User::create([
        'nom' => $validated['nom'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'rue' => $validated['rue'],
        'code_postal' => $validated['code_postal'],
        'ville' => $validated['ville'],
        'pays' => $validated['pays'],
        'phone' => $validated['phone'],
        'role' => 'user',
    ]);

    Coordonnee::create([
        'nom' => $validated['nom'],
        'email' => $validated['email'],
        'rue' => $validated['rue'],
        'code_postal' => $validated['code_postal'],
        'ville' => $validated['ville'],
        'pays' => $validated['pays'],
        'telephone' => $validated['phone'],
        'user_id' => $user->id,
    ]);

    event(new Registered($user));
    auth()->login($user);

    return redirect()->route('dashboard')->with('success', 'Inscription réussie !');
}
}
