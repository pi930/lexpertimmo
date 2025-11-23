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

        $user = User::firstOrCreate(
            ['email' => 'lexpertimmo06@gmail.com'],
            [
                'name' => 'Admin',
                'nom' => 'Admin',
                'password' => Hash::make('Guetteur.Ap1624'),
                'role' => 'Admin',
                'email_verified_at' => now(),
            ]
        );

        // Envoie l'e-mail de vérification si nécessaire
        // if (!$user->hasVerifiedEmail()) {
        //     $user->sendEmailVerificationNotification();
        // }
    }
}
