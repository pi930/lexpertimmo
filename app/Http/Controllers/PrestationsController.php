<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestation;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class PrestationsController extends Controller
{
    // 🧾 Affiche la liste des prestations
    public function index()
{
    $prestations = Prestation::all();
    return view('prestations', compact('prestations'));
}

    // ✅ Enregistre les prestations sélectionnées dans la session
    public function selectionner(Request $request)

    {   $request->validate([
    'prestations' => 'array',
    'prestations.*' => 'integer|exists:prestations,id',
]);
        $selection = $request->input('prestations', []);
        session(['prestations' => $selection]);

        return redirect()->route('devis.generer');
    }

public function show($id)
{
    if (Auth::id() != $id) {
        return redirect()->route('login');
    }

    $prestations = Prestation::all();
    $latestNotifications = Notification::latest()->take(5)->get();

    return view('prestations', [
        'user' => Auth::user(),
        'prestations' => $prestations,
        'latestNotifications' => $latestNotifications ,
    ]);
}
public function public()
{
    $prestations = Prestation::all();

    return view('prestations', [
        'prestations' => $prestations,
        'user' => null // ou 'visiteur' si tu veux afficher un message
    ]);
}
}
