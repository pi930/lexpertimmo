<?php

namespace App\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class RendezvousService
{
    public function genererPropositions($zone, $travailHeure)
    {
        $propositions = [];

        // Générer des créneaux sur 10 jours
        $jours = CarbonPeriod::create(now(), '1 day', now()->addDays(10));

        foreach ($jours as $jour) {
            if ($jour->isWeekend()) continue;

            if ($travailHeure <= 4) {
                $propositions[] = [
                    'id' => uniqid(), // identifiant unique
                    'zone' => $zone,
                    'date' => $jour->copy()->setTime(9, 0),
                    'travail_heure' => $travailHeure
                ];
                $propositions[] = [
                    'id' => uniqid(),
                    'zone' => $zone,
                    'date' => $jour->copy()->setTime(14, 0),
                    'travail_heure' => $travailHeure
                ];
            }

            if (count($propositions) >= 3) break;
        }

        return $propositions;
    }
}