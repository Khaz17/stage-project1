<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Marque;

class MarqueController extends Controller
{
    // Liste des marques
    public function index(){
        return view('marques.marques-list');
    }

    public function addMarque(Request $request){
        $validator = \Validator::make($request->all(),[
            'nom_m' => 'required|string|unique:marques',
        ],[
            'nom_m.required' => '?',
            'nom_m.string' => 'Le nom doit être une chaîne de charactères',
            'nom_m.unique' => 'Marque déjà enregistrée',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        } else {
            $marque = new Marque();
            $marque->nom_m = $request->nom_m;
            $query = $marque->save();

            if(!$query){
                return response()->json(['code'=>0, 'msg'=>"Oups ! Quelque chose s'est mal passé"]);
            } else {
                return response()->json(['code'=>1, 'msg'=>'Nouvelle marque enregistrée !']);
            }
        }
    }

    public function getMarquesList(){
        $marques = Marque::all();
        return DataTables::of($marques)
                        ->addColumn('actions', function($row){
                            return '<div class="btn-group">
                            <button type="button" class="btn btn-sm btn-alt-primary" data-id="'.$row['id'].'" id="editMarqueBtn" data-bs-toggle="tooltip" title="Modifier marque">
                              <i class="fa fa-fw fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-danger" data-id="'.$row['id'].'" id="deleteMarqueBtn" data-bs-toggle="tooltip" title="Supprimer marque">
                              <i class="fa fa-fw fa-times"></i>
                            </button>
                          </div>';
                        })
                        ->rawColumns(['actions'])
                        ->make(true);
    }

    //Get détails marque
    public function getMarqueDetails(Request $request){
        $marque = Marque::find($request->marque_id);
        return response()->json(['code'=>1,'result'=>$marque]);
    }

    public function updateMarque(Request $request){
        $marque_id = $request->mid;

        $validator = \Validator::make($request->all(),[
            'nom_m' => 'required|string|unique:marques,nom_m,'.$marque_id,
        ],[
            'nom_m.required' => '?',
            'nom_m.string' => 'Le nom doit être une chaîne de charactères',
            'nom_m.unique' => 'Marque déjà enregistrée',
        ]);
        if (!$validator->passes()) {
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        } else {
            $marque = Marque::find($marque_id);
            $marque->nom_m = $request->nom_m;
            $query = $marque->save();

            if(!$query){
                return response()->json(['code'=>0, 'msg'=>"Oups ! Quelque chose s'est mal passé"]);
            } else {
                return response()->json(['code'=>1, 'msg'=>'Marque mise à jour !']);
            }
        }

    }

    public function deleteMarque(Request $request){
        $marque = Marque::find($request->marque_id);
        $query = $marque->delete();

        if(!$query){
            return response()->json(['code'=>0, 'msg'=>"Oups ! Quelque chose s'est mal passé"]);
        } else {
            return response()->json(['code'=>1, 'msg'=>'Marque supprimée !']);
        }
    }
}
