<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 't.pierrard.13.198@outlook.fr'],
            [
                'name' => 'Admin',
                'nom' => 'Admin',
                'password' => Hash::make('Guetteur.Ap1624'),
                'role' => 'Admin',
                'email_verified_at' => null, // Assure que l'e-mail est non vérifié
            ]
        );

        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
        }
    }
}
