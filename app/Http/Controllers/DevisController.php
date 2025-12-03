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
use App\Models\Notification;
use Illuminate\Support\Facades\Http; // ⚡ à ajouter en haut

class DevisController extends Controller
{  // Dans ton controller

    public function calculerPrix($typeBien, $surface, $options)
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

    // Notifications pour le menu
    $latestNotifications = Notification::latest()->take(5)->get();

    // ⚠️ On ne crée PAS de devis ici
    // On garde seulement les données en session
    session([
        'typeBien'   => $typeBien,
        'surface'    => $surface,
        'options'    => $options,
        'prixTotal'  => $prixTotal
    ]);

    // On affiche uniquement le résultat
    return view('devis.resultat', compact('typeBien', 'surface', 'options', 'prixTotal', 'latestNotifications'));
}
    public function formulaire()
{
    return view('devis.formulaire');
}
private function calculerHeuresTravail(string $surface, array $options): int
{
    $points = 0;

    // Zone habitable
    switch($surface) {
        case '<50m²':
        case '<100m²':
            $points += 1;
            break;
        case '<150m²':
        case '<200m²':
            $points += 3;
            break;
    }

    // Gaz
    if(in_array('gaz_chaudiere', $options)) $points += 1;
    if(in_array('gaz_cuisson', $options)) $points += 1;

    // Plomb
    if(in_array('plomb', $options)) {
        $points += 1;
    }

    // Zone non habitable
    if(in_array('zone_non_habitable_50', $options)) $points += 1;
    if(in_array('zone_non_habitable_100', $options)) $points += 2;
    if(in_array('zone_non_habitable_150', $options)) $points += 3;
    if(in_array('zone_non_habitable_200', $options)) $points += 3; // ⚡ correction ici

    // Calcul des heures
    if($points <= 3) {
        return 2;
    } elseif($points < 6) {
        return 3;
    } else {
        return 4;
    }
}
    

public function generer(Request $request, $prestationId = null)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('redirect_after_login', 'devis');
    }

    $user      = Auth::user();
    $typeBien  = session('typeBien');
    $surface   = session('surface');
    $options   = session('options', []);
    $prixTotal = session('prixTotal');

    if (!$typeBien || !$surface || !$prixTotal) {
        return redirect()->route('devis.calculer')->with('error', 'Session expirée, veuillez recalculer votre devis.');
    }

    // 1) Création du devis (le PDF sera sauvé après que les prestations soient attachées)
    $filename = 'devis_' . time() . '.pdf';

    $devis = Devis::create([
        'user_id'   => $user->id,
        'pdf_path'  => $filename,
        'total_ttc' => $prixTotal,
        'status'    => 'en attente',
        'nom'       => $user->name,
        'email'     => $user->email,
        'objet'     => "Devis {$typeBien} - {$surface}",
    ]);

    // 2) Heures de travail et zone
    $devis->heures_travail = $this->calculerHeuresTravail($surface, $options);

    if (!empty($user->adresse)) {
        $response = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
            'address' => $user->adresse,
            'key'     => config('services.google_maps.key'),
        ]);

        if (!empty($response['results'][0]['geometry']['location'])) {
            $lat = $response['results'][0]['geometry']['location']['lat'];
            $lng = $response['results'][0]['geometry']['location']['lng'];

            $zones       = DB::table('zones')->get();
            $zoneProche  = null;
            $minDistance = PHP_INT_MAX;

            foreach ($zones as $zone) {
                $distance = $this->distanceKm($lat, $lng, $zone->latitude, $zone->longitude);
                if ($distance < $minDistance) {
                    $minDistance = $distance;
                    $zoneProche  = $zone;
                }
            }

            if ($zoneProche) {
                $devis->zone_id = $zoneProche->id;
            }
        }
    }

    $devis->save();

    // 3) Ajouter les lignes principales
    DevisLigne::create([
        'devis_id'         => $devis->id,
        'designation'      => "Diagnostics obligatoires {$typeBien} - {$surface}",
        'quantite'         => 1,
        'prix_unitaire_ht' => $prixTotal,
        'tva'              => 20,
        'total_ttc'        => $prixTotal,
    ]);

    // 4) Attacher les prestations via les options
    $labels = [
        'gaz_cuisson'              => 'Gaz cuisson',
        'gaz_chaudiere'            => 'Gaz chaudière',
        'plomb'                    => 'Plomb (maison < 1949)',
        'zone_non_habitable_50'   => 'Zone non habitable < 50m²',
        'zone_non_habitable_100'  => 'Zone non habitable < 100m²',
        'zone_non_habitable_150'  => 'Zone non habitable < 150m²',
        'zone_non_habitable_200'  => 'Zone non habitable < 200m²',
    ];

    foreach ($options as $opt) {
        $prixOption = $this->calculerPrixOption($opt, $typeBien, $surface);

        DevisLigne::create([
            'devis_id'         => $devis->id,
            'designation'      => $labels[$opt] ?? ucfirst(str_replace('_', ' ', $opt)),
            'quantite'         => 1,
            'prix_unitaire_ht' => $prixOption,
            'tva'              => 20,
            'total_ttc'        => $prixOption,
        ]);

        $prestation = Prestation::where('titre', $opt)->first();
        if ($prestation) {
            $devis->prestations()->attach($prestation->id, [
                'quantite'         => 1,
                'prix_unitaire_ht' => $prixOption,
                'tva'              => 20,
                'total_ttc'        => $prixOption,
            ]);
        }
    }

    // 5) Récupérer les prestations attachées (variable AU PLURIEL)
    $prestations = $devis->prestations()->get()->map(function ($p) {
        return [
            'nom'  => $p->titre,
            'prix' => $p->pivot->total_ttc ?? $p->prix,
        ];
    });

    // 6) Générer et sauvegarder le PDF
    // Assure-toi que storage/app/private/devis existe et que le disk 'devis_private' pointe dessus si tu l'utilises
    $pdf = Pdf::loadView('devis.template', compact(
        'typeBien', 'surface', 'options', 'prixTotal', 'user', 'prestations'
    ));

    $pdf->save(storage_path('app/private/devis/' . $filename));

    // 7) Envoyer l’email
    Mail::to($devis->email)->send(new DevisCree($devis));

    return redirect()->route('dashboard')->with([
        'success'    => '✅ Votre devis a été créé et envoyé !',
        'devis_link' => route('devis.download', $devis->id),
    ]);
}
public function download($id)
{
   logger(Auth::user()->role);

    $devis = Devis::findOrFail($id);

    // Vérification des droits (propriétaire ou admin)
    $user = Auth::user();
    if ($user->id !== $devis->user_id && $user->role !== 'Admin') {
        abort(403, 'Accès refusé');
    }

    return Storage::disk('devis_private')->download($devis->pdf_path);
}// Dans ton controller
public function index()
{
    $user = Auth::user();

    if ($user->role === 'Admin') {
        // Admin voit tous les devis avec leurs lignes et objets
        $devisList = Devis::with('devisLignes.objet', 'user')->latest()->paginate(10);
    } else {
        // Utilisateur voit uniquement ses devis
        $devisList = Devis::with('devisLignes.objet')
                          ->where('user_id', $user->id)
                          ->latest()
                          ->paginate(10);
    }

    return view('dashboard.devis', [
        'devis' => $devisList, // collection paginée
        'admin' => $user->role === 'Admin'
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

    // Récupérer les dernières notifications
    $latestNotifications = Notification::latest()->take(5)->get();

    // 🔒 Sécurité : vérifier qu'un utilisateur est connecté
    if (!$user) {
        abort(403, 'Vous devez être connecté pour accéder à ce devis.');
    }

    // 🔒 Seul l'Admin ou le propriétaire peut voir le devis
    if ($user->role !== 'Admin' && $devis->user_id !== $user->id) {
        abort(403, 'Accès interdit à ce devis.');
    }

    return view('Admin.devis.show', [
        'devis' => $devis,
        'admin' => $user->role === 'Admin',
        'latestNotifications' => $latestNotifications,
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

public function AdminDashboard()
{
    $devis = Devis::latest()->paginate(10);

    return view('admin.dashboard', compact('devis'));
}

    
}
