<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class IsAdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 't.pierrard.13.198@outlook.fr'],
            [
                'name' => 'IsAdmin',
                'nom' => 'IsAdmin',
                'password' => Hash::make('Guetteur.Ap1624'),
                'role' => 'IsAdmin',
                'email_verified_at' => null, // Assure que l'e-mail est non vérifié
            ]
        );

        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
        }
    }
}
