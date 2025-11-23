<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Coordonnee;

class CoordonneesController extends Controller
{  
     public function index()
{
    $coordonnees = Coordonnee::where('user_id', Auth::id())->first();

    return view('dashboard.coordonnees', compact('coordonnees'));
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'rue' => 'required|string',
            'code_postal' => 'required|string',
            'ville' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email',
            'pays' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        Coordonnee::updateOrCreate(['user_id' => Auth::id()], $validated);

        return redirect()->route('coordonnees.show');
    }

    public function show()
    {
      $user = Auth::user();
    $coordonnees = Coordonnee::where('user_id', $user->id)->get();
    $admin= $user->role === 'Admin'; // ou selon ton système de rôle

    return view('dashboard.coordonnees', compact('coordonnees', 'admin','user'));

    }

    public function showAdmin($userId)
    {
        $coordonnees = Coordonnee::where('user_id', $userId)->first();
        return view('dashboard.coordonnees_Admin', compact('coordonnees'));
    }
    public function edit()
{
    $user = Auth::user();
    $coordonnees = Coordonnee::where('user_id', $user->id)->first();
    $admin = $user->role === 'Admin';

    return view('dashboard.coordonnees', compact('coordonnees', 'user', 'admin'));
}

public function update(Request $request)
{
    $validated = $request->validate([
        'nom' => 'required|string',
        'rue' => 'required|string',
        'code_postal' => 'required|string',
        'ville' => 'required|string',
        'telephone' => 'required|string',
        'email' => 'required|email',
        'pays' => 'required|string',
    ]);

    Coordonnee::updateOrCreate(['user_id' => Auth::id()], $validated);

    return redirect()->route('coordonnees.show')->with('success', 'Coordonnées mises à jour.');
}
}
