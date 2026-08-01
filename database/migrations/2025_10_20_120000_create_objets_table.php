<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('objets', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->string('nom'); // Nom de l'objet
            $table->text('description')->nullable(); // Description facultative
            $table->decimal('prix_unitaire_ht', 10, 2); // Prix hors taxe
            $table->decimal('tva', 5, 2); // Taux de TVA
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('objets');
    }
};
