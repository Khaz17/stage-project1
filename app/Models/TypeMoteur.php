<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMoteur extends Model
{
    use HasFactory;

    protected $fillable = ['libelle_tm'];

    public function vehicules(){
        return $this->hasMany(Vehicule::class);
    }
}
