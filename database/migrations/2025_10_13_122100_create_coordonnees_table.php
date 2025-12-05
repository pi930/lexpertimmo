<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('coordonnees', function (Blueprint $table) {
            $table->id(); // équivalent à bigint unsigned auto-increment
            $table->string('nom')->nullable(); 
            $table->string('rue')->nullable();
            $table->string('code_postal')->nullable();
            $table->string('ville')->nullable();
            $table->string('pays');
            $table->string('telephone')->nullable();
            $table->string('email');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // bigint unsigned + clé étrangère
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coordonnees');
    }
};
