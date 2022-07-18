<?php

namespace App\Http\Controllers;

use App\Models\Conducteur;
use Illuminate\Http\Request;

class ConducteurController extends Controller
{
    public function index(){
        $conducteurs = Conducteur::all();
        return view('conducteurs.conducteurs-list', compact('conducteurs'));
    }

    public function showAddPage(){
        return view('conducteurs.add-conducteur');
    }

    public function addConducteur(){

    }

    public function getConducteursList(){

    }

    public function getConducteurDetails(){

    }

    public function updateConducteur(){

    }

    public function deleteConducteur(){

    }
}
