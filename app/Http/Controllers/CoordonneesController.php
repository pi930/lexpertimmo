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
    $user = Auth::user();
    $coordonnees = Coordonnee::where('user_id', $user->id)->first();

    return view('coordonnees.edit', compact('user', 'coordonnees'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'adresse' => 'nullable|string',
        'telephone' => 'nullable|string',
        'ville' => 'nullable|string',
        'code_postal' => 'nullable|string',
    ]);

    $validated['user_id'] = Auth::id();

    Coordonnee::create($validated);

    return redirect()->route('user.dashboard', Auth::id());
}

public function update(Request $request)
{
    $validated = $request->validate([
        'adresse' => 'nullable|string',
        'telephone' => 'nullable|string',
        'ville' => 'nullable|string',
        'code_postal' => 'nullable|string',
    ]);

    Coordonnee::updateOrCreate(
        ['user_id' => Auth::id()],
        $validated
    );

    return redirect()->route('user.dashboard', Auth::id());
}

}