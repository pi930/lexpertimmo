<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Enregistre les commandes Artisan personnalisées.
     */
    protected $commands = [
        // Tu peux ajouter ici tes commandes personnalisées, par exemple :
        // \App\Console\Commands\TonNomDeCommande::class,
    ];

    /**
     * Définit les tâches planifiées.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Exemple : planifier une commande tous les jours à minuit
        // $schedule->command('ton:commande')->daily();
    }

    /**
     * Enregistre les fichiers de commandes.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
