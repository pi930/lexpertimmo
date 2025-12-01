<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('rendezvous', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->nullable();
        $table->string('zone'); // Nice, Cannes, Grasse
        $table->dateTime('date');
        $table->integer('travail_heure'); // durée en heures
        $table->boolean('bloque')->default(false);

        // Champs adresse
        $table->string('rue')->nullable();
        $table->string('code_postal', 10)->nullable();
        $table->string('ville')->nullable();


        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('rendezvous');
}
};
