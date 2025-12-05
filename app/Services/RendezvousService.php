<?php

namespace App\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Rendezvous;

class RendezvousService
{
    public function genererPropositions($coordonnee, $travailHeure, $zone)
    {
        $propositions = [];
        $jours = CarbonPeriod::create(now(), '1 day', now()->addDays(10));

        foreach ($jours as $jour) {
            if ($jour->isWeekend()) continue;

            // Vérifier s'il existe déjà des rendez-vous dans cette zone pour ce jour
            $rdvExistants = Rendezvous::whereDate('date', $jour)
                ->where('zone', $zone)
                ->where('bloque', true)
                ->count();

            // Coordonnées sécurisées
            $rue        = is_object($coordonnee) ? $coordonnee->rue : 'Rue inconnue';
            $code_postal= is_object($coordonnee) ? $coordonnee->code_postal : '00000';
            $ville      = is_object($coordonnee) ? $coordonnee->ville : 'Ville inconnue';

            if ($travailHeure <= 4) {
                if ($rdvExistants > 0) {
                    // Proposer d'autres créneaux le même jour dans la même zone
                    $creneaux = [9, 14];
                    foreach ($creneaux as $heure) {
                        $propositions[] = [
                            'id'           => uniqid(),
                            'zone'         => $zone,
                            'rue'          => $rue,
                            'code_postal'  => $code_postal,
                            'ville'        => $ville,
                            'date'         => $jour->copy()->setTime($heure, 0),
                            'travail_heure'=> $travailHeure,
                        ];
                    }
                } else {
                    // Si pas de dispo dans la zone, appliquer la règle des 2 jours
                    $diff = $jour->diffInDays(now());

                    if ($diff > 2) {
                        // Décaler à un autre jour
                        $propositions[] = [
                            'id'           => uniqid(),
                            'zone'         => $zone,
                            'rue'          => $rue,
                            'code_postal'  => $code_postal,
                            'ville'        => $ville,
                            'date'         => $jour->copy()->addDay()->setTime(9, 0),
                            'travail_heure'=> $travailHeure,
                        ];
                    } else {
                        // Si moins de 2 jours, proposer une autre zone
                        $propositions[] = [
                            'id'           => uniqid(),
                            'zone'         => 'Autre zone',
                            'rue'          => $rue,
                            'code_postal'  => $code_postal,
                            'ville'        => $ville,
                            'date'         => $jour->copy()->setTime(9, 0),
                            'travail_heure'=> $travailHeure,
                        ];
                    }
                }
            }

            if (count($propositions) >= 3) break;
        }

        return $propositions;
    }
}