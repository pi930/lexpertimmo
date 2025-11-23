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

            // 🔐 Lien avec l'utilisateur (optionnel)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            // 🔢 Référence unique du devis
            $table->string('reference')->unique()->nullable();

            // 💰 Montant total TTC du devis
            $table->decimal('total_ttc', 10, 2);

            // ⏳ Date d'expiration du devis (optionnelle)
            $table->timestamp('expires_at')->nullable();

            // 📌 Statut du devis
            $table->enum('status', ['en attente', 'validé', 'ticket'])->default('en attente');

            // 📇 Coordonnées utilisateur (copiées à la création)
            $table->string('nom')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();

            // 💬 Message personnalisé de l'utilisateur (optionnel)
            $table->text('message')->nullable();

            // 🕒 Dates de création et de mise à jour
            $table->timestamps();

            // 🔍 Index pour les requêtes fréquentes
            $table->index(['user_id', 'status']);
            $table->string('pdf_path')->nullable();
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
