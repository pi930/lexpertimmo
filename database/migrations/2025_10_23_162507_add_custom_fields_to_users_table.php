<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('name')->nullable();
        $table->string('rue')->nullable();
        $table->string('code_postal')->nullable();
        $table->string('ville')->nullable();
        $table->string('pays')->nullable();
        $table->string('phone')->nullable();
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['nom', 'rue', 'code_postal', 'ville', 'pays', 'phone']);
    });
}
};
