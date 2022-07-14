<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use App\Models\Modele;
use Illuminate\Http\Request;

use DataTables;

class ModeleController extends Controller
{
    // Liste des modèles

    public function index(){
        $marques = Marque::all();
        return view('modeles.modeles-list', compact('marques'));
    }

    public function addModele(Request $request){
        $validator = \Validator::make($request->all(),[
            'libelle_m' => 'required|string|unique:modeles',
            'marque' => 'required|not_in:0'
        ],[
            'libelle_m.required' => '?',
            'libelle_m.string' => 'Le libellé doit être une chaîne de charactères',
            'libelle_m.unique' => 'Modèle déjà enregistré',
            'marque.required' => 'Le nom de la marque est obligatoire',
            'marque.not_in' => 'Le nom de la marque est obligatoire'
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        } else {
            $modele = new Modele();
            $modele->libelle_m = $request->libelle_m;
            $modele->marque_id = $request->marque;
            $query = $modele->save();

            if(!$query){
                return response()->json(['code'=>0, 'msg'=>"Oups ! Quelque chose s'est mal passé"]);
            } else {
                return response()->json(['code'=>1, 'msg'=>'Nouveau modèle enregistré !']);
            }
        }
    }

    public function getModelesList(){
        $modeles = Modele::all();
        // return view('modeles.modeles-list', compact('modele'));
        return DataTables::of($modeles)
                        ->addColumn('actions', function($row){
                            return '<div class="btn-group">
                            <button type="button" class="btn btn-sm btn-alt-primary" data-id="'.$row['id'].'" id="editModeleBtn" data-bs-toggle="tooltip" title="Modifier modèle">
                              <i class="fa fa-fw fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-danger" data-id="'.$row['id'].'" id="deleteModeleBtn" data-bs-toggle="tooltip" title="Supprimer modèle">
                              <i class="fa fa-fw fa-times"></i>
                            </button>
                          </div>';
                        })
                        ->rawColumns(['actions'])
                        ->make(true);
    }

    //Get détails modèle
    public function getModeleDetails(Request $request){
        $modele = Modele::find($request->modele_id);
        return response()->json(['code'=>1,'result'=>$modele]);
    }

    public function updateModele(Request $request){
        $modele_id = $request->mid;

        $validator = \Validator::make($request->all(),[
            'libelle_m' => 'required|string|unique:modeles,libelle_m,'.$modele_id,
            'marque_id' => 'required'
        ],[
            'libelle_m.required' => '?',
            'libelle_m.string' => 'Le libellé doit être une chaîne de charactères',
            'libelle_m.unique' => 'Modèle déjà enregistré',
            'marque_id.required' => 'Le nom de la marque est obligatoire'
        ]);
        if (!$validator->passes()) {
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        } else {
            $modele = Modele::find($modele_id);
            $modele->libelle_m = $request->libelle_m;
            $modele->marque_id = $request->marque;
            $query = $modele->save();

            if(!$query){
                return response()->json(['code'=>0, 'msg'=>"Oups ! Quelque chose s'est mal passé"]);
            } else {
                return response()->json(['code'=>1, 'msg'=>'Modèle mis à jour !']);
            }
        }

    }

    public function deleteModele(Request $request){
        $modele = Modele::find($request->modele_id);
        $query = $modele->delete();

        if(!$query){
            return response()->json(['code'=>0, 'msg'=>"Oups ! Quelque chose s'est mal passé"]);
        } else {
            return response()->json(['code'=>1, 'msg'=>'Modèle supprimé !']);
        }
    }
}
