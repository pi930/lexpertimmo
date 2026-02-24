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

        $messages = Message::where('user_id', $user->id)->latest()->paginate(10);
        $coordonnees = $user->coordonnee ?? null;
        $devis = Devis::where('user_id', $user->id)->paginate(10);
        $rendezvous = Rendezvous::where('user_id', $user->id)->latest()->get();
        $admin = $user->role === 'Admin';
        $latestNotifications = Notification::latest()->take(5)->get();

        $propositions = [];
        $dernierDevis = Devis::where('user_id', $user->id)->latest()->first();

        if ($coordonnees && $dernierDevis) {
            $propositions = $this->rendezvousService->genererPropositions(
                $coordonnees->rue,
                $coordonnees->code_postal,
                $coordonnees->ville ?? 'Nice',
                $dernierDevis->heures_travail
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
        $request->validate([
            'zone'          => 'required|string',
            'date'          => 'required|date',
            'travail_heure' => 'required|integer|min:1',
            'rue'           => 'required|string',
            'code_postal'   => 'required|string',
            'ville'         => 'required|string',
        ]);

        $date = Carbon::parse($request->date);

        $rdvExistant = Rendezvous::where('zone', $request->zone)
            ->whereDate('date', $date->toDateString())
            ->whereTime('date', $date->format('H:i:s'))
            ->where('bloque', true)
            ->first();

        if ($rdvExistant) {
            return back()->with('error', '❌ Ce créneau est déjà bloqué.');
        }

        Rendezvous::create([
            'user_id'       => auth()->id(),
            'zone'          => $request->zone,
            'date'          => $date,
            'travail_heure' => $request->travail_heure,
            'bloque'        => true,
            'rue'           => $request->rue,
            'code_postal'   => $request->code_postal,
            'ville'         => $request->ville,
        ]);

        return redirect()->route('user.rendezvous')
                         ->with('success', '✅ Rendez-vous réservé avec succès.');
    }

    public function bloquer($id)
    {
        $rdv = Rendezvous::findOrFail($id);

        // Ne pas écraser le user_id si admin
        if (auth()->user()->role !== 'Admin') {
            $rdv->update(['user_id' => auth()->id()]);
        }

        $rdv->update(['bloque' => true]);

        return redirect()->route('user.rendezvous');
    }

    public function indexAdmin()
    {
        $rendezvousBloques = Rendezvous::where('bloque', true)
                                       ->latest()
                                       ->paginate(15);

        $devisList = Devis::with(['user', 'devisLignes.objet'])
                          ->latest()
                          ->paginate(15);

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

    public function updateAdmin(Request $request, $id)
    {
        $rdv = Rendezvous::findOrFail($id);

        $rdv->update($request->validate([
            'date'          => 'required|date',
            'zone'          => 'required|string|max:255',
            'travail_heure' => 'required|integer|min:1',
        ]));

        return redirect()
            ->route('admin.rendezvous.edit', $id)
            ->with('success', 'Rendez-vous mis à jour.');
    }

    public function supprimer($id)
    {
        $rdv = Rendezvous::findOrFail($id);

        $rdv->update([
            'bloque'  => false,
            'user_id' => null,
        ]);

        if (auth()->user()->role === 'Admin') {
            return redirect()
                ->route('admin.rendezvous')
                ->with('success', 'Rendez-vous libéré par l’Admin.');
        }

        return redirect()
            ->route('user.rendezvous')
            ->with('success', 'Rendez-vous supprimé.');
    }
}
