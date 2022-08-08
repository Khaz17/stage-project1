<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilansJournaliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilans_journaliers', function (Blueprint $table) {
            $table->id();
            $table->integer('kilometrage');
            $table->integer('qte_essence_consommee');
            $table->integer('recette_journaliere');
            $table->date('date_bilan');
            $table->timestamps();

            $table->foreignId('vehicule_id')->constrained();
            $table->foreignId('conducteur_id')->constrained();
            $table->unique(['date_bilan', 'vehicule_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bilans_journaliers');
    }
}
