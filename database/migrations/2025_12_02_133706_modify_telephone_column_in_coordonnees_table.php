<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTelephoneColumnInCoordonneesTable extends Migration
{
    public function up()
    {
        Schema::table('coordonnees', function (Blueprint $table) {
            $table->string('telephone')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('coordonnees', function (Blueprint $table) {
            $table->string('telephone')->change(); // ou revert selon besoin
        });
    }
}
