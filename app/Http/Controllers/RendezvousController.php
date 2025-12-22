<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Devis;
use App\Models\Rendezvous;
use App\Services\RendezvousService;
use App\Models\Notification;


class RendezvousController extends Controller
{
    
    
    protected $rendezvousService;

   public function __construct(RendezvousService $rendezvousService)
    {
        $this->rendezvousService = $rendezvousService;
    }


public function indexUser()
{
    $user = auth()->user();

    // Messages de l'utilisateur
    $messages = Message::where('user_id', $user->id)->latest()->paginate(10);

    // Coordonnées de l'utilisateur
    $coordonnees = $user->coordonnee ?? null;

    // Tous les devis de l'utilisateur (pagination)
    $devis = Devis::where('user_id', $user->id)->paginate(10);

    // Rendez-vous existants
    $rendezvous = Rendezvous::where('user_id', $user->id)->latest()->get();

    // Vérification du rôle
    $admin = $user->role === 'Admin';
    $latestNotifications = Notification::latest()->take(5)->get(); // exemple

    // Propositions de rendez-vous
    $propositions = [];

    // On génère des propositions uniquement si l'utilisateur a des coordonnées et au moins un devis
    $dernierDevis = Devis::where('user_id', $user->id)->latest()->first();

    if ($coordonnees && $dernierDevis) {
        $rue         = $coordonnees->rue ?? '';
        $code_postal = $coordonnees->code_postal ?? '';
        $ville       = $coordonnees->ville ?? 'Nice';

        $travailHeure = $dernierDevis->heures_travail ?? null;

        $propositions = $this->rendezvousService->genererPropositions(
            $rue,
            $code_postal,
            $ville,
            $travailHeure
        );
    }

    return view('Admin.dashboard_user', compact(
        'user',
        'messages',
        'coordonnees',
        'devis',
        'rendezvous',
        'admin',
        'propositions',
        'latestNotifications'

    ));
}

  public function propositions()
{
    return $this->indexUser();
}


public function reserver(Request $request)
{
    // Vérifier si un RDV bloqué existe déjà pour la même date et heure
    $rdvExistant = Rendezvous::where('zone', $request->zone)
        ->whereDate('date', $request->date)
        ->whereTime('date', Carbon::parse($request->date)->format('H:i:s'))
        ->where('bloque', true)
        ->first();

    if ($rdvExistant) {
        return redirect()->back()
            ->with('error', '❌ Ce créneau est déjà bloqué, choisissez une autre date ou heure.');
    }

    // Création du rendez-vous en base
    $rdv = Rendezvous::create([
        'user_id'      => auth()->id(),
        'zone'         => $request->zone,
        'date'         => $request->date,
        'travail_heure'=> $request->travail_heure,
        'bloque'       => true,
        'rue'          => $request->rue,
        'code_postal'  => $request->code_postal,
        'ville'        => $request->ville,
    ]);

    return redirect()->route('user.rendezvous')
                     ->with('success', '✅ Rendez-vous réservé avec succès.');
}

    public function bloquer($id)
    {
        $rdv = Rendezvous::findOrFail($id);
        $rdv->update(['bloque' => true, 'user_id' => auth()->id()]);
        return redirect()->route('user.rendezvous');
    }


 public function indexAdmin()
{
    // Tous les rendez-vous bloqués
    $rendezvousBloques = Rendezvous::where('bloque', true)
                                   ->latest()
                                   ->paginate(15);

    // Tous les devis (avec pagination pour éviter de charger trop d'entrées d'un coup)
    $devisList = Devis::with(['user', 'devisLignes.objet']) // ⚡ eager loading pour éviter N+1
                      ->latest()
                      ->paginate(15);

    // Tu peux aussi charger les messages si ton dashboard admin en a besoin
    $messages = Message::latest()->paginate(10);

    return view('Admin.dashboard_Admin', compact(
        'rendezvousBloques',
        'devisList',
        'messages'
    ));
}

public function edit($id)
{
    $rdv = Rendezvous::findOrFail($id);

    return view('Admin.rendezvous_edit', compact('rdv'));
}



public function updateAdmin (Request $request, $id)
{
    $rdv = Rendezvous::findOrFail($id);

    $rdv->update($request->validate([
        'date' => 'required|date',
        'zone' => 'required|string|max:255',
        'travail_heure' => 'required|integer|min:1',
    ]));

    if (auth()->user()->role === 'Admin') {
        return redirect()
            ->route('admin.rendezvous.edit', $id)
            ->with('success', 'Rendez-vous mis à jour par Admin.');
    }

    return redirect()
        ->route('user.rendezvous')
        ->with('success', 'Rendez-vous mis à jour.');
}



 public function supprimer($id)
{
    $rdv = Rendezvous::findOrFail($id);

    // Libérer le rendez-vous
    $rdv->update([
        'bloque'  => false,
        'user_id' => null,
    ]);

    // Redirection selon le rôle
    if (auth()->check() && auth()->user()->role === 'Admin') {
        return redirect()
            ->route('admin.rendezvous')
            ->with('success', 'Rendez-vous libéré par l’Admin.');
    }

    return redirect()
        ->route('user.rendezvous')
        ->with('success', 'Rendez-vous supprimé.');
}

}