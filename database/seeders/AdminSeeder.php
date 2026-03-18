<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Simule l'envoi des notifications en environnement local
        if (app()->environment('local')) {
            Notification::fake();
        }
User::updateOrCreate(
    ['email' => 'lexpertimmo06@gmail.com'],
    [
        'nom' => 'Admin',
        'rue' => 'Adresse admin',
        'code_postal' => '00000',
        'ville' => 'Cannes',
        'pays' => 'France',
        'phone' => '0000000000',
        'password' => Hash::make('Guetteur.Ap1624'),
        'role' => 'admin',
        'email_verified_at' => now(),
    ]
);


        // Envoie l'e-mail de vérification si nécessaire
        // if (!$user->hasVerifiedEmail()) {
        //     $user->sendEmailVerificationNotification();
        // }
    }
}
