<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:show-Admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    $user = \App\Models\User::where('email', 'lexpertimmo06@gmail.com')->first();

    if ($user) {
        $this->info("Nom : {$user->name}");
        $this->info("Email : {$user->email}");
        $this->info("Rôle : {$user->role}");
    } else {
        $this->error("Utilisateur non trouvé.");
    }
}
}
