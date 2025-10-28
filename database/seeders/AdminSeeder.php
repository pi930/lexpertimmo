<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'lexpertimmo06@gmail.com'],
            [
                'name' => 'Admin',
                'nom' => 'Admin',
                'password' => Hash::make('Sauveur.Ap1624'),
                'role' => 'admin',
            ]
        );
    }
}
