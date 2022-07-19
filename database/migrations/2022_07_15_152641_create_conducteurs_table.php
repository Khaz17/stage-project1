<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConducteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conducteurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_c');
            $table->string('prenom_c');
            $table->date('date_naissance_c');
            $table->string('telephone_c');
            $table->string('email_c');
            $table->string('adresse_c');
            $table->string('type_permis');
            $table->date('delivrance_p');
            $table->date('expiration_p');
            $table->string('scan_permis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conducteurs');
    }
}
