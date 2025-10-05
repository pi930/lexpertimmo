<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestation;

class PrestationsController extends Controller
{
    // 🧾 Affiche la liste des prestations
    public function index()
    {
        $prestations = Prestation::all();
        return view('prestations.index', compact('prestations'));
    }

    // ✅ Enregistre les prestations sélectionnées dans la session
    public function selectionner(Request $request)
    {
        $selection = $request->input('prestations', []);
        session(['prestations' => $selection]);

        return redirect()->route('devis.generer');
    }
}