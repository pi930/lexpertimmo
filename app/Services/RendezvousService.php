<?php

namespace App\Services;

use App\Models\Rendezvous;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RendezvousService
{
    public function genererPropositions($rue, $code_postal, $ville, $travailHeure)
    {
        $travailHeure = $travailHeure ?? 1;

        // 1) Déterminer la zone la plus proche
        $zone = $this->trouverZoneProche($rue, $code_postal, $ville);

        // 2) Générer des créneaux intelligents
        return $this->genererCreneauxDisponibles($zone, $travailHeure);
    }

    private function trouverZoneProche($rue, $code_postal, $ville)
    {
        $adresse = "$rue $code_postal $ville";

        $response = \Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
            'address' => $adresse,
            'key'     => config('services.google_maps.key'),
        ]);

        if (empty($response['results'][0]['geometry']['location'])) {
            return Zone::first(); // fallback
        }

        $lat = $response['results'][0]['geometry']['location']['lat'];
        $lng = $response['results'][0]['geometry']['location']['lng'];

        $zones = Zone::all();
        $zoneProche = null;
        $minDistance = PHP_INT_MAX;

        foreach ($zones as $zone) {
            $distance = $this->distanceKm($lat, $lng, $zone->latitude, $zone->longitude);
            if ($distance < $minDistance) {
                $minDistance = $distance;
                $zoneProche = $zone;
            }
        }

        return $zoneProche;
    }

    private function genererCreneauxDisponibles($zone, $travailHeure)
    {
        $propositions = [];
        $start = Carbon::now()->addHour(); // premier créneau possible

        // On génère 3 créneaux valides
        while (count($propositions) < 3) {

            // Respect des horaires (8h–18h)
            if ($start->hour < 8) $start->setHour(8);
            if ($start->hour >= 18) $start->addDay()->setHour(8);

            $dateFin = $start->copy()->addHours($travailHeure);

            // Vérifier si un RDV existe déjà dans cette zone
            $collision = Rendezvous::where('zone', $zone->nom)
                ->where(function ($q) use ($start, $dateFin) {
                    $q->whereBetween('date', [$start, $dateFin])
                      ->orWhereBetween(
    DB::raw("date + (travail_heure || ' hour')::interval"),
    [$start, $dateFin]
);
                })
                ->where('bloque', true)
                ->exists();

            if (!$collision) {
                $propositions[] = [
                    'zone'          => $zone->nom,
                    'date'          => $start->copy(),
                    'date_fin'      => $dateFin,
                    'travail_heure' => $travailHeure,
                ];
            }

            $start->addHour();
        }

        return $propositions;
    }

    private function distanceKm($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat/2) ** 2 +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon/2) ** 2;

        return $earthRadius * 2 * atan2(sqrt($a), sqrt(1-$a));
    }
}
