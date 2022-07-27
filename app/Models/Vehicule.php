<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_chassis',
        'immatriculation',
        'nbre_places',
        'prix_acquisition',
        'date_acquisition',
        'consommation_de_base',
        'recette_hebdo_attendue',
        'modele_id',
        'type_moteur_id',
        'usage_id',
    ];

    public function modele(){
        return $this->belongsTo(Modele::class);
    }

    public function typeMoteur(){
        return $this->belongsTo(TypeMoteur::class);
    }

    // public function usage(){
    //     return $this->belongsTo(usage::class);
    // }
}
