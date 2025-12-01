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
    $coordonnees = $user->coordonnee ?? null;
    $devis = Devis::where('user_id', $user->id)->latest()->paginate(10);
    $rendezvous = Rendezvous::where('user_id', $user->id)->latest()->get();
    $admin = $user->role === 'Admin';

    $propositions = [];
    if ($rendezvous->isEmpty()) {
        $service = new RendezvousService();
        $zone = $coordonnees->ville ?? 'Nice';
        $propositions = $service->genererPropositions($zone, 2);
    }

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
        $rdv = Rendezvous::findOrFail($id);
        $rdv->update(['bloque' => true, 'user_id' => auth()->id()]);
        return redirect()->route('user.rendezvous');
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
        'date' => 'required|date',
        'zone' => 'required|string|max:255',
        'travail_heure' => 'required|integer|min:1',
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