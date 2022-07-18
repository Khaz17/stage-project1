<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conducteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_c',
        'prenom_c',
        'telephone_c',
        'email_c',
        'adresse_c',
        'type_permis',
        'date_delivrance_permis',
        'date_renouvellement_permis',
        'scan_permis'
    ];
}
