<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConducteurSaveRequest;
use App\Models\Conducteur;
use Illuminate\Support\Facades\DB;

class ConducteurController extends Controller
{
    public function index(){
        $conducteurs = Conducteur::all();
        return view('conducteurs.conducteurs-list', compact('conducteurs'));
    }

    public function showAddPage(){
        $types_permis = DB::table('type_permis')->orderBy('nomination')->pluck('nomination');
        return view('conducteurs.add-conducteur', compact('types_permis'));
    }

    public function saveConducteur(ConducteurSaveRequest $request){
        $nom_c = $request->nom_c;
        $prenom_c = $request->prenom_c;

        $check = Conducteur::where('nom_c',$nom_c)->where('prenom_c',$prenom_c)->count();

        if ($check>0) {
            return response()->json(['code'=>0, 'msg'=>"Conducteur déjà enregistré"]);
        } else {
            $conducteur = new Conducteur();
            $conducteur->nom_c = $request->nom_c;
            $conducteur->prenom_c = $request->prenom_c;
            $conducteur->date_naissance_c = $request->date_naissance_c;
            $conducteur->telephone_c = $request->telephone_c;
            $conducteur->email_c = $request->email_c;
            $conducteur->adresse_c = $request->adresse_c;
            $conducteur->type_permis = $request->type_permis;
            $conducteur->delivrance_p = $request->delivrance_p;
            $conducteur->expiration_p = $request->expiration_p;

            if ($request->hasfile('scan_permis')) {
	            $fileUrl = $request->file('scan_permis');
	            $fileNameToStore = uniqid().'_' .time().'.'.$fileUrl->getClientOriginalExtension();
	            $destinationPath = public_path('/uploads/conducteurs/');
	            $upload = $fileUrl->move($destinationPath, $fileNameToStore); //Ajouter scan
                $conducteur->scan_permis = $fileNameToStore;
                $query = $conducteur->save();
            }

            if ($upload) {

                if ($query) {
                    return back()->with('success','Le nouveau conducteur a été enregistré');
                } else {
                    return back()->with('fail',"Quelque chose s'est mal passé");
                }

            } else {
                return back()->with('fail',"Quelque chose s'est mal passé");
            }

            // return view('conducteurs.conducteurs-list');
        }

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
