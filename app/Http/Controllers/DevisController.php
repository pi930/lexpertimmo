<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Prestation;
use App\Mail\DevisCree;
use App\Models\Devis;
use App\Models\DevisLigne;
use App\Models\Objet;

class DevisController extends Controller
{  public function calculerPrix($typeBien, $surface, $options)
{
    $basePrix = match([$typeBien, $surface]) {
        ['vente', '<50m²'] => 290,
        ['vente', '<100m²'] => 390,
        ['vente', '<150m²'] => 470,
        ['vente', '<200m²'] => 550,
        ['location', '<50m²'] => 269,
        ['location', '<100m²'] => 350,
        ['location', '<150m²'] => 450,
        ['location', '<200m²'] => 490,
    };

    foreach ($options as $option) {
        $basePrix += match($option) {
            'gaz_cuisson' => 40,
            'gaz_chaudiere' => 50,
            'plomb' => 50,
            'zone_non_habitable_50' => 70,
            'zone_non_habitable_100' => 100,
            'zone_non_habitable_150' => 130,
            'zone_non_habitable_200' => 160,
            default => 0,
        };
    }

    return $basePrix;
} 

    public function calculer(Request $request)
{
    $request->validate([
        'typeBien' => 'required|in:vente,location',
        'surface' => 'required|in:<50m²,<100m²,<150m²,<200m²',
        'options' => 'array'
    ]);

    $typeBien = $request->input('typeBien');
    $surface = $request->input('surface');
    $options = $request->input('options', []);
    $prixTotal = $this->calculerPrix($typeBien, $surface, $options);

    // Enregistrement en base
    if (Auth::check()) {
        Devis::create([
            'user_id' => Auth::id(),
            'typeBien' => $typeBien,
            'surface' => $surface,
            'options' => json_encode($options),
            'total_ttc' => $prixTotal
        ]);
    }

    session([
        'typeBien' => $typeBien,
        'surface' => $surface,
        'options' => $options,
        'prixTotal' => $prixTotal
    ]);

    return view('devis.resultat', compact('typeBien', 'surface', 'options', 'prixTotal'));
}
    
    public function generer(Request $request, $prestationId = null)
{
       $user = Auth::user();

 //   if (is_null($user->email_verified_at)) {
 //       return redirect()->route('verification.notice')->with('error', 'Veuillez vérifier votre adresse email.');
//    }

    // 🔐 Authentification
    if (!Auth::check()) {
        return redirect()->route('login')->with('redirect_after_login', 'devis');
    }

    $user = Auth::user();

    // 📦 Préchargement depuis une prestation si fournie
    if ($prestationId) {
        $prestation = Prestation::find($prestationId);

        if (!$prestation) {
            return redirect()->route('prestations')->with('error', 'Prestation introuvable.');
        }

        session()->put([
            'typeBien'   => session('typeBien', 'vente'),
            'surface'    => session('surface', '<100m²'),
            'options'    => session('options', [$prestation->titre]),
            'prixTotal'  => session('prixTotal', $prestation->prix),
        ]);
    }

    // 🧾 Récupération des données du devis
    $typeBien   = session('typeBien');
    $surface    = session('surface');
    $options    = session('options', []);
    $prixTotal  = session('prixTotal');

    if (!$typeBien || !$surface || !$prixTotal) {
        return redirect()->route('devis.calculer')->with('error', 'Session expirée, veuillez recalculer votre devis.');
    }

    // 🧮 Calcul des prestations
    $prestations = collect($options)->map(fn($opt) => [
        'nom'  => $opt,
        'prix' => $this->calculerPrixOption($opt, $typeBien, $surface),
    ]);

// 📄 Génération du PDF
$pdf = Pdf::loadView('devis.template', compact('typeBien', 'surface', 'prestations', 'prixTotal', 'user'));
$filename = 'devis_' . time() . '.pdf';
Storage::put("devis/$filename", $pdf->output());

// 🗂️ Enregistrement du devis
$devis = Devis::create([
    'user_id'   => $user->id,
    'pdf_path'  => "devis/$filename",
    'total_ttc' => $prixTotal,
    'status'    => 'en attente',
    'nom'       => $user->name,
    'email'     => $user->email,
    'objet'     => "Devis {$typeBien} - {$surface}",
]);

// 📧 Envoi du mail
Mail::to($devis->email)->send(new DevisCree($devis));

    // 📧 Envoi du mail
   $user = Auth::user();
   \Log::info("Tentative d'envoi de mail à : " . $user->email);
 try {
  Mail::raw('Test de mail Laravel', function ($message) use ($user) {
    $message->to($user->email)->subject('Test simple');
});
} catch (\Exception $e) {
    \Log::error("Erreur d'envoi de mail : " . $e->getMessage());
}

    // ✅ Redirection vers le dashboard
    $dashboardRoute = $user->role === 'IsAdmin'
        ? route('Isdmin.dashboard_addmin', ['id' => $user->id])
        : route('user.dashboard', ['id' => $user->id]);

    return redirect($dashboardRoute)->with([
        'success'    => '✅ Votre devis a été créé et envoyé !',
        'devis_link' => Storage::url("devis/$filename"),
    ]);
    }
public function index()
{
    $user = Auth::user();

    if ($user->role === 'IsAdmin') {
        // IsAdmin voit tous les devis avec leurs lignes et objets
        $devis = Devis::with('devisLignes.objet')->latest()->paginate(10);
    } else {
        // Utilisateur voit uniquement ses devis
        $devis = Devis::with('devisLignes.objet', 'user')->latest()->paginate(10);
    }

 return view('dashboard.devis', [
    'devis' => $devis, // collection paginée
    'IsAdmin' => $user->role === 'IsAdmin'
]);
}
private function calculerPrixOption(string $opt, string $typeBien, string $surface): int
{
    return match($opt) {
        'gaz_cuisson' => 40,
        'gaz_chaudiere' => $typeBien === 'vente' ? 50 : 30,
        'plomb' => match($surface) {
            '<50m²' => 50,
            '<100m²' => $typeBien === 'vente' ? 90 : 80,
            '<150m²' => $typeBien === 'vente' ? 130 : 110,
            '<200m²' => $typeBien === 'vente' ? 170 : 140,
            default => 0,
        },
        'zone_non_habitable_50' => 70,
        'zone_non_habitable_100' => 100,
        'zone_non_habitable_150' => 130,
        'zone_non_habitable_200' => 160,
        default => 0,
    };
}

public function show($id)
{
    $user = Auth::user();
    $devis = Devis::with('devisLignes.objet', 'user')->findOrFail($id);

    // 🔒 Sécurité : seul l'IsAdmin ou le propriétaire peut voir le devis
    if ($user->role !== 'IsAdmin' && $devis->user_id !== $user->id) {
        abort(403, 'Accès interdit à ce devis.');
    }

    return view('IsAdmin.devis.show', [
    'devis' => $devis,
    'IsAdmin' => $user->role === 'IsAdmin'
]);
}

public function destroy($id)
{
    $devis = Devis::findOrFail($id);

    if ($devis->pdf_path && Storage::exists($devis->pdf_path)) {
        Storage::delete($devis->pdf_path);
    }

    $devis->delete();

    return redirect()->back()->with('success', '🗑️ Le devis a été supprimé.');
}

public function IsAdminDashboard()
{
    $devis = Devis::latest()->paginate(10);

    return view('IsAdmin.dashboard_IsAdmin', compact('devis'));
}
    
}