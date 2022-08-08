<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BilanJournalier extends Model
{
    use HasFactory;

    public $table = 'bilans_journaliers';

    public function vehicule(){
        return $this->belongsTo(Vehicule::class);
    }
}
