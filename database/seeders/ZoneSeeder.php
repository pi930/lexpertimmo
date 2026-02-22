<?php 

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoneSeeder extends Seeder
{
    public function run()
    {
        DB::table('zones')->insert([
            [
                'nom' => 'Nice Gare',
                'latitude' => 43.7045,   // Gare Nice Ville
                'longitude' => 7.2619,
                'rayon_km' => 10,
            ],
            [
                'nom' => 'Grasse Vieille Ville',
                'latitude' => 43.6584,   // Centre historique de Grasse
                'longitude' => 6.9231,
                'rayon_km' => 10,
            ],
            [
                'nom' => 'Cannes Gare',
                'latitude' => 43.5528,   // Gare de Cannes
                'longitude' => 7.0174,
                'rayon_km' => 10,
            ],
        ]);
    }
}