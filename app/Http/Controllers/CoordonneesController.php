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

    public function showAdmin($userId)
    {
        $coordonnees = Coordonnee::where('user_id', $userId)->first();
        return view('dashboard.coordonnees_Admin', compact('coordonnees'));
    }
 

public function edit()
{
   

    // On récupère ses coordonnées si elles existent

    $coordonnees = auth()->user()->coordonnee; // peut être null

    // On envoie à la vue (même si null)
    return view('coordonnees.edit', compact('coordonnees'));
}


public function store(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'nom' => 'nullable|string',
        'rue' => 'nullable|string',
        'telephone' => 'nullable|string',
        'ville' => 'nullable|string',
        'code_postal' => 'nullable|string',
        'pays' => 'nullable|string',
        'email' => 'nullable|email',
    ]);

    $validated['user_id'] = $user->id;

    Coordonnee::create($validated);

    return redirect()->route('dashboard.user')->with('success', 'Coordonnées enregistrées.');
}


public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nom' => 'nullable|string',
        'rue' => 'nullable|string',
        'telephone' => 'nullable|string',
        'ville' => 'nullable|string',
        'code_postal' => 'nullable|string',
        'pays' => 'nullable|string',
        'email' => 'nullable|email',
    ]);

    $coordonnees = Coordonnee::findOrFail($id);

    $coordonnees->update($validated);

    return redirect()->route('dashboard.user')->with('success', 'Coordonnées mises à jour.');
}
}