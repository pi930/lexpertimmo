<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('devis', function (Blueprint $table) {
            $table->id();

            // 🔐 Lien avec l'utilisateur
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            // 📄 Fichier PDF stocké
            $table->string('pdf_path');

            // 💰 Montant total TTC
            $table->decimal('total_ttc', 10, 2);

            // 📆 Date de création
            $table->timestamp('created_at')->useCurrent();

            // ⏳ Expiration (optionnel)
            $table->timestamp('expires_at')->nullable();

            // 📌 Statut du devis
            $table->enum('status', ['en attente', 'validé', 'ticket'])->default('en attente');

            // 📇 Coordonnées utilisateur (copiées au moment de la création)
            $table->string('nom')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();

            // 💬 Message utilisateur (optionnel)
            $table->text('message')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devis');
    }
};