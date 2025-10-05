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
{
    public function generer(Request $request)

{
    // 🔐 Vérification d'authentification AVANT toute action
    if (!Auth::check()) {
        return redirect()->route('login')->with('redirect_after_login', 'devis');
    }

    $user = Auth::user();

    // 🧾 Récupération des prestations (à adapter selon ta logique)
    $prestations = session('prestations', []);
    $totalTTC = collect($prestations)->sum('prix');
    $TTC = $totalTTC;

    // 📄 Génération du PDF
    $pdf = Pdf::loadView('devis.template', compact('prestations', 'TTC'));
    $filename = 'devis_' . time() . '.pdf';
    Storage::put("devis/$filename", $pdf->output());

    // 🗂️ Enregistrement en base
    $devis = Devis::create([
        'user_id' => $user->id,
        'pdf_path' => "devis/$filename",
        'total_ttc' => $TTC,
        'status' => 'en attente',
    ]);

    // 📧 Envoi du mail
    Mail::to($user->email)->send(new DevisCree($devis));

    // ✅ Redirection vers confirmation ou dashboard
    return redirect()->route('dashboard')->with('success', 'Votre devis a été créé et envoyé !');
}
}
 
