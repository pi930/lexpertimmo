<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Devis;
use App\Mail\DevisCree;

class DevisController extends Controller
{   private function calculerPrix($typeBien, $surface, $options)
{
    $basePrix = match([$typeBien, $surface]) {             ['vente', '<50m²'] => 290,
            ['vente', '<100m²'] => 390,
            ['vente', '<150m²'] => 470,
            ['vente', '<200m²'] => 550,
            ['location', '<50m²'] => 269,
            ['location', '<100m²'] => 350,
            ['location', '<150m²'] => 450,
            ['location', '<200m²'] => 490,
 };
    foreach ($options as $option) {
        $basePrix += match($option) { 'gaz_cuisson' => 40,
                'gaz_chaudiere' => $typeBien === 'vente' ? 50 : 30,
                'plomb' => match($surface) {
                    '<50m²' => 50,
                    '<100m²' => $typeBien === 'vente' ? 90 : 80,
                    '<150m²' => $typeBien === 'vente' ? 130 : 110,
                    '<200m²' => $typeBien === 'vente' ? 170 : 140,
                },
                'zone_non_habitable_50' => 70,
                'zone_non_habitable_100' => 100,
                'zone_non_habitable_150' => 130,
                'zone_non_habitable_200' => 160,
                default => 0, };
    }
    return $basePrix;
}
    public function calculer(Request $request)
    {
        // Validation des champs
        $request->validate([
            'typeBien' => 'required|in:vente,location',
            'surface' => 'required|in:<50m²,<100m²,<150m²,<200m²',
            'options' => 'array'
        ]);

        $typeBien = $request->input('typeBien');
        $surface = $request->input('surface');
        $options = $request->input('options', []);

        $prixTotal = $this->calculerPrix($typeBien, $surface, $options);

        // Prix de base selon type de bien et surface

        // Stockage temporaire pour génération PDF
        session([
            'typeBien' => $typeBien,
            'surface' => $surface,
            'options' => $options,
            'prixTotal' => $prixTotal
        ]);

        return view('devis.resultat', compact('typeBien', 'surface', 'options', 'prixTotal'));
    }

    public function generer(Request $request)
    {  

        // 🔐 Vérification d'authentification
        if (!Auth::check()) {
            return redirect()->route('login')->with('redirect_after_login', 'devis');
        }

        $user = Auth::user();

        // 🧾 Récupération des données du devis depuis la session
        $typeBien = session('typeBien');
        $surface = session('surface');
        $options = session('options', []);
        $prixTotal = session('prixTotal');
        
        if (!$typeBien || !$surface || !$prixTotal) {
    return redirect()->route('devis.calcul')->with('error', 'Session expirée, veuillez recalculer votre devis.');
}

        // Formatage des prestations pour le PDF
        $prestations = collect($options)->map(function ($opt) use ($typeBien, $surface) {
            return [
                'nom' => $opt,
                'prix' => match($opt) {
                    'gaz_cuisson' => 40,
                    'gaz_chaudiere' => $typeBien === 'vente' ? 50 : 30,
                    'plomb' => match($surface) {
                        '<50m²' => 50,
                        '<100m²' => $typeBien === 'vente' ? 90 : 80,
                        '<150m²' => $typeBien === 'vente' ? 130 : 110,
                        '<200m²' => $typeBien === 'vente' ? 170 : 140,
                    },
                    'zone_non_habitable_50' => 70,
                    'zone_non_habitable_100' => 100,
                    'zone_non_habitable_150' => 130,
                    'zone_non_habitable_200' => 160,
                    default => 0,
                }
            ];
        });

        // 📄 Génération du PDF
        $pdf = Pdf::loadView('devis.template', compact('typeBien', 'surface', 'prestations', 'prixTotal'));
        $filename = 'devis_' . time() . '.pdf';
        Storage::put("devis/$filename", $pdf->output());

        // 🗂️ Enregistrement en base
      $devis = Devis::create([
    'user_id' => $user->id,
    'pdf_path' => "devis/$filename",
    'total_ttc' => $prixTotal,
    'status' => 'en attente',
    'nom' => $user->name,
    'email' => $user->email,
    'objet' => "Devis {$typeBien} - {$surface}",
    'montant' => $prixTotal,
]);

        // 📧 Envoi du mail
        Mail::to($user->email)->send(new DevisCree($devis));

        // ✅ Redirection
    return redirect()->route($user->is_admin ? 'admin.dashboard' : 'user.dashboard')->with([
    'success' => 'Votre devis a été créé et envoyé !',
    'devis_link' => Storage::url("devis/$filename")
]);

    }
    
}