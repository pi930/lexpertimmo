<?php

namespace App\Services;

use App\Models\Rendezvous;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RendezvousService
{
public function genererPropositions($rue, $code_postal, $ville, $travailHeure)
    {
        // Valeur par défaut si aucune durée n’est fournie
        $travailHeure = $travailHeure ?? 1;

        // Point de départ : maintenant
        $start = Carbon::now();

        // Générer 3 propositions espacées
        $propositions = [];

        for ($i = 1; $i <= 3; $i++) {
            $dateDebut = $start->copy()->addHours($i); // créneau à +1h, +2h, +3h
            $dateFin   = $dateDebut->copy()->addHours($travailHeure);

            $propositions[] = [
                'zone'          => "Zone $i",
                'date'          => $dateDebut,
                'date_fin'      => $dateFin,
                'travail_heure' => $travailHeure,
                'rue'           => $rue,
                'code_postal'   => $code_postal,
                'ville'         => $ville,
            ];
        }

        return $propositions;
    }

    private function distanceKm($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon/2) * sin($dLon/2);

        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $earthRadius * $c;
    }
}

