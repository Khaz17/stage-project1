<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('numero_chassis');
            $table->string('immatriculation');
            $table->integer('nbre_places');
            $table->integer('prix_acquisition');
            $table->date('date_acquisition');
            $table->double('consommation_de_base');
            $table->integer('recette_hebdo_attendue');
            $table->timestamps();

            $table->foreignId('modele_id')->constrained();
            $table->foreignId('type_moteur_id')->constrained();
            $table->foreignId('usage_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicules');
    }
}
