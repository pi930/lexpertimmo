<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{     
   public function create()
{

    return view('auth.register');
}

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        Log::info('Tentative de création utilisateur', $request->all());

       $request->validate([
    'nom' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
    'rue' => ['required', 'string'],
    'code_postal' => ['required', 'string'],
    'ville' => ['required', 'string'],
    'pays' => ['required', 'string'],
    'telephone' => ['required', 'string'],

    
]);

        $user = User::create([
            'nom' => $request ->nom,
            'rue' => $request->rue,
            'code_postal' => $request->code_postal,
            'ville' => $request->ville,
            'pays' => $request ->pays,
            'phone' => $request->telephone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // ou 'admin' si tu veux tester'
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('admin.dashboard_user', absolute: false));
    }
}
