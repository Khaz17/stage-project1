<?php

namespace App\Http\Controllers;
use App\Models\TypeMoteur;

use Illuminate\Http\Request;
use DataTables;

class TypeMoteursController extends Controller
{
    // Liste des types de moteurs

    public function index(){
        return view('typesmoteurs.typesmoteurs-list');
    }

    public function addTypemoteur(Request $request){
        $validator = \Validator::make($request->all(),[
            'libelle_tm' => 'required|string|unique:type_moteurs',
        ],[
            'libelle_tm.required' => '?',
            'libelle_tm.string' => 'Le libellé doit être une chaîne de charactères',
            'libelle_tm.unique' => 'Type déjà enregistré',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        } else {
            $typemoteur = new TypeMoteur();
            $typemoteur->libelle_tm = $request->libelle_tm;
            $query = $typemoteur->save();

            if(!$query){
                return response()->json(['code'=>0, 'msg'=>"Oups ! Quelque chose s'est mal passé"]);
            } else {
                return response()->json(['code'=>1, 'msg'=>'Nouveau type de moteur enregistré !']);
            }
        }
    }

    public function getTypemoteursList(){
        $typemoteurs = TypeMoteur::all();
        return DataTables::of($typemoteurs)
                        ->addColumn('actions', function($row){
                            return '<div class="btn-group">
                            <button type="button" class="btn btn-sm btn-alt-primary" data-id="'.$row['id'].'" id="editTypemoteurBtn" data-bs-toggle="tooltip" title="Modifier type">
                              <i class="fa fa-fw fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-danger" data-id="'.$row['id'].'" id="deleteTypemoteurBtn" data-bs-toggle="tooltip" title="Supprimer type">
                              <i class="fa fa-fw fa-times"></i>
                            </button>
                          </div>';
                        })
                        ->rawColumns(['actions'])
                        ->make(true);
        // return response()->json($typemoteurs);
    }

    //Get détails type moteur
    public function getTypemoteurDetails(Request $request){
        $typemoteur = TypeMoteur::find($request->typemoteur_id);
        return response()->json(['code'=>1,'result'=>$typemoteur]);
    }

    public function updateTypemoteur(Request $request){
        $typemoteur_id = $request->tmid;

        $validator = \Validator::make($request->all(),[
            'libelle_tm' => 'required|string|unique:type_moteurs,libelle_tm,'.$typemoteur_id,
        ],[
            'libelle_tm.required' => '?',
            'libelle_tm.string' => 'Le libellé doit être une chaîne de charactères',
            'libelle_tm.unique' => 'Type déjà enregistré',
        ]);
        if (!$validator->passes()) {
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        } else {
            $typemoteur = TypeMoteur::find($typemoteur_id);
            $typemoteur->libelle_tm = $request->libelle_tm;
            $query = $typemoteur->save();

            if(!$query){
                return response()->json(['code'=>0, 'msg'=>"Oups ! Quelque chose s'est mal passé"]);
            } else {
                return response()->json(['code'=>1, 'msg'=>'Type de moteur mis à jour !']);
            }
        }

    }

    public function deleteTypemoteur(Request $request){
        $typemoteur = TypeMoteur::find($request->typemoteur_id);
        $query = $typemoteur->delete();

        if(!$query){
            return response()->json(['code'=>0, 'msg'=>"Oups ! Quelque chose s'est mal passé"]);
        } else {
            return response()->json(['code'=>1, 'msg'=>'Type de moteur supprimé !']);
        }
    }
}
