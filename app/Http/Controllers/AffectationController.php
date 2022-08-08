<?php

namespace App\Http\Controllers;

use App\Http\Requests\AffectationSaveRequest;
use App\Http\Requests\AffectationUpdateRequest;
use App\Models\Affectation;
use App\Models\Conducteur;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AffectationController extends Controller
{
    public function index(){
        $affectations = Affectation::join('vehicules','affectations.vehicule_id','=','vehicules.id')
                                    ->join('conducteurs','affectations.conducteur_id','=','conducteurs.id')
                                    ->whereNull('date_fin')
                                    ->get(['affectations.*','vehicules.immatriculation','conducteurs.nom_c','conducteurs.prenom_c']);

        $oldaffectations = Affectation::join('vehicules','affectations.vehicule_id','=','vehicules.id')
                                    ->join('conducteurs','affectations.conducteur_id','=','conducteurs.id')
                                    ->whereNotNull('date_fin')
                                    ->get(['affectations.*','vehicules.immatriculation','conducteurs.nom_c','conducteurs.prenom_c']);
        return view('affectations.affectations-list', compact('affectations','oldaffectations'));
    }

    public function showAddPage(){
        $vehicules = Vehicule::all();
        $conducteurs = Conducteur::all();
        return view('affectations.add-affectation', compact('vehicules','conducteurs'));
    }

    public function saveAffectation(AffectationSaveRequest $request){
        $vda_id = $request->vehicule;
        $cda_id = $request->conducteur;

        $vda = DB::table('affectations')->where('vehicule_id',$vda_id)->where('date_fin',null)->count();
        $cda = DB::table('affectations')->where('conducteur_id',$cda_id)->where('date_fin',null)->count();

        if ($vda > 0 || $cda > 0) {
            $pa = DB::table('affectations')->where('conducteur_id',$cda_id)
                                        ->where('date_fin', null)
                                        ->update(['date_fin'=>now()]);
        }

        $affectation = new Affectation();
        $affectation->date_realisation = $request->date_realisation;
        $affectation->vehicule_id = $request->vehicule;
        $affectation->conducteur_id = $request->conducteur;

        $query = $affectation->save();

        if (!$query) {
            return back()->with('fail',"Quelque chose s'est mal passé !");
        } else {
            return back()->with('success',"L'affectation a été réalisée avec succès !");
        }

    }

    // public function showEditPage($id){
    //     $affectation = Affectation::find($id);
    //     $vehicules = Vehicule::all();
    //     $conducteurs = Conducteur::all();
    //     return view('affectations.add-affectation', compact('affectation','vehicules','conducteurs'));
    // }

    // public function updateAffectation(AffectationUpdateRequest $request){
    //     $affectation = Affectation::find($request->aid);
    //     $affectation->date_realisation = $request->date_realisation;
    //     $affectation->vehicule_id = $request->vehicule;
    //     $affectation->conducteur_id = $request->conducteur;

    //     $query = $affectation->save();

    //     if (!$query) {
    //         return back()->with('fail',"Quelque chose s'est mal passé !");
    //     } else {
    //         return back()->with('success',"L'affectation a été mise à jour avec succès !");
    //     }
    // }

    public function getAffectationDetails($id){
        $affectation = Affectation::find($id)
                                    ->join('conducteur');
        return view('affectations.details-affectation','affectation');
    }

    // public function deleteAffectation($id){
    //     $affectation = Affectation::find($id);
    //     $query = $affectation->delete();

    //     if ($query) {
    //         return back()->with('success',"L'affectation a été supprimée");
    //     } else {
    //         return back()->with('fail',"Quelque chose s'est mal passé");
    //     }

    // }

    public function disableAffectation($id){
        // $query = DB::table('affectations')->where('conducteur_id',$id)
        //                                 ->update(['date_fin'=>now()]);

        $query = DB::table('affectations')->where('id', $id)
                                        ->update(['date_fin'=>now()]);

        if ($query) {
            return back()->with('success',"L'affectation a été désactivée");
        } else {
            return back()->with('fail',"Quelque chose s'est mal passé");
        }
    }
}
