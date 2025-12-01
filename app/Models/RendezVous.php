<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Database\Eloquent\Factories\HasFactory;


    class Rendezvous extends Model
{
     protected $table = 'rendezvous'; // 👈 force le nom correct

    protected $fillable = ['user_id','zone','date','travail_heure','bloque','rue','code_postal','ville'];

    public function scopeDisponible($query) {
        return $query->where('bloque', false);
    }
}

class RendezvousService
{
    public function genererPropositions($zone, $travailHeure)
    {
        $propositions = [];

        // Exemple simplifié : matin (9h-13h) et après-midi (14h-18h)
        $jours = CarbonPeriod::create(now(), '1 day', now()->addDays(10));

        foreach ($jours as $jour) {
            if ($jour->isWeekend()) continue;

            // Vérifier si créneau dispo
            if ($travailHeure <= 4) {
                $propositions[] = [
                    'zone' => $zone,
                    'date' => $jour->copy()->setTime(9, 0),
                    'travail_heure' => $travailHeure
                ];
                $propositions[] = [
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