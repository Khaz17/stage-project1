<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle_m',
        'marque_id'
    ];

    public function marque(){
        return $this->belongsTo(Marque::class);
    }

    public function vehicules(){
        return $this->hasMany(Vehicule::class);
    }
}
