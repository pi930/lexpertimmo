<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rendezvous', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            
            // Infos générales
            $table->dateTime('date');
            $table->string('statut')->default('en_attente'); // en_attente, confirmé, annulé
            $table->text('notes')->nullable();

            // Infos logistiques
            $table->string('zone')->nullable(); // Nice, Cannes, Grasse
            $table->integer('travail_heure')->nullable(); // durée en heures
            $table->boolean('bloque')->default(false);

            // Adresse
            $table->string('rue')->nullable();
            $table->string('code_postal', 10)->nullable();
            $table->string('ville')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rendezvous');
    }
};
