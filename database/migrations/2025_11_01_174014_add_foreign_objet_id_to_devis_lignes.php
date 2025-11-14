<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('devis_lignes', function (Blueprint $table) {
            // Ajoute la contrainte uniquement si elle n'existe pas
           $table->foreign('objet_id')
                  ->references('id')
                  ->on('objets')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('devis_lignes', function (Blueprint $table) {
            // Supprime la contrainte si elle existe
            $table->dropForeign(['objet_id']);
        });
    }
};
