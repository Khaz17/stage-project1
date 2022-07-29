<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_realisation',
        'vehicule_id',
        'conducteur_id',
    ];

    public function vehicule(){
        return $this->belongsTo(Vehicule::class);
    }

    public function conducteur(){
        return $this->belongsTo(Conducteur::class);
    }
}
