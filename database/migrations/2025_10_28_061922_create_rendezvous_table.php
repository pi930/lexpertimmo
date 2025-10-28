<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rendezvous', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->dateTime('date'); // Date et heure du rendez-vous
            $table->string('statut')->default('en_attente'); // Statut : en_attente, confirmé, annulé
            $table->text('notes')->nullable(); // Notes internes ou commentaires
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rendezvous');
    }
};
