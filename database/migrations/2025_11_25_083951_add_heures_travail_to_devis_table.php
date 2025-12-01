<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('devis', function (Blueprint $table) {
        $table->integer('heures_travail')->default(0)->after('pdf_path');
    });
}

public function down(): void
{
    Schema::table('devis', function (Blueprint $table) {
        $table->dropColumn('heures_travail');
    });
}
};
