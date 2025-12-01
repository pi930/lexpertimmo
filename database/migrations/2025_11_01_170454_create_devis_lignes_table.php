<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
   Schema::create('devis_lignes', function (Blueprint $table) {
    $table->id();

    // 🔗 Lien vers le devis
    $table->foreignId('devis_id')->constrained()->onDelete('cascade');

    // 🔗 Lien vers un objet (optionnel)
    $table->foreignId('objet_id')->nullable()->constrained()->onDelete('set null');

    // 📦 Détails de la ligne
    $table->string('designation');
    $table->integer('quantite')->default(1);
    $table->decimal('prix_unitaire_ht', 10, 2);
    $table->decimal('tva', 5, 2)->default(0); // en %
    
    // 💰 Montant total TTC de la ligne
    $table->decimal('total_ttc', 10, 2);

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('devis_lignes');
    }
};
