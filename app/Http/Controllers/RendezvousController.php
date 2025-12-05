<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Devis;
use App\Models\Rendezvous;
use App\Services\RendezvousService;


class RendezvousController extends Controller
{public function indexUser()
{
    $user = auth()->user();

    $messages = Message::where('user_id', $user->id)->latest()->paginate(10);
    $coordonnees = $user->coordonnee ;
    $devis = Devis::where('user_id', $user->id)->latest()->paginate(10);
    $rendezvous = Rendezvous::where('user_id', $user->id)->latest()->get();
    $admin = $user->role === 'Admin';

    $propositions = [];
if ($rendezvous->isEmpty()) {
    $service = new RendezvousService();
    $zone = $coordonnees->ville ?? 'Zone inconnue';
$propositions = $service->genererPropositions($coordonnees, 2, $zone);
    session(['propositions' => $propositions]);}


    return view('Admin.dashboard_user', compact(
        'user','messages','coordonnees','devis','rendezvous','admin','propositions'
    ));
}
public function propositions()
{
    return $this->indexUser();
}

  public function bloquer($id)
{
    $user = auth()->user();

    // Récupérer les propositions depuis la session (ou ton service)
    $propositions = session('propositions', []);

    // Vérifier que la proposition existe
    if (!isset($propositions[$id])) {
        return back()->with('error', 'Proposition introuvable.');
    }

    $proposition = $propositions[$id];

    // Créer un nouveau rendez-vous en base
 $rdv = Rendezvous::create([
    'user_id'     => $user->id,
    'rue'         => $proposition['rue'],
    'code_postal' => $proposition['code_postal'],
    'ville'       => $proposition['ville'],
    'date'        => $proposition['date'],
    'bloque'      => true,
]);

    return redirect()->route('user.rendezvous')
    ->with('success', 'Rendez-vous réservé : ' 
        . $rdv->rue . ', ' . $rdv->code_postal . ' ' . $rdv->ville 
        . ' le ' . $rdv->date->format('d/m/Y H:i'));

}

    public function supprimer($id)
    {
        $rdv = Rendezvous::findOrFail($id);
        $rdv->update(['bloque' => false, 'user_id' => null]);
        return back()->with('success', 'Rendez-vous supprimé.');
    }
    public function indexAdmin()
{
    $rendezvous = Rendezvous::where('bloque', true)->latest()->paginate(15);
    return view('Admin.dashboard_Admin', compact('rendezvous'));
}

public function edit($id)
{
    $rdv = Rendezvous::findOrFail($id);
    return view('Admin.dashboard_Admin', compact('rdv'));
}

public function update(Request $request, $id)
{
    $rdv = Rendezvous::findOrFail($id);

    $rdv->update($request->validate([
        'date'         => 'required|date',
        'rue'          => 'required|string|max:255',
        'code_postal'  => 'required|string|max:10',
        'ville'        => 'required|string|max:255',
        'travail_heure'=> 'required|integer|min:1',
    ]));

    return redirect()->route('admin.rendezvous')
                     ->with('success', 'Rendez-vous mis à jour.');
}

public function supprimerAdmin($id)
{
    $rdv = Rendezvous::findOrFail($id);
    $rdv->update(['bloque' => false, 'user_id' => null]);

    return redirect()->route('admin.rendezvous')
                     ->with('success', 'Rendez-vous libéré par l’admin.');
}
    

}