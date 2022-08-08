<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehiculeSaveRequest;
use App\Http\Requests\VehiculeUpdateRequest;
use App\Models\Affectation;
use App\Models\Modele;
use App\Models\TypeMoteur;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // $vehicules = vehicule::join('modeles','vehicules.modele_id','=','modeles.id')->get(['vehicules.*','modeles.libelle_m']);
        // $modeles = Modele::join('marques','modeles.marque_id', '=', 'marques.id')
        //                     ->get(['modeles.*','marques.nom_m']);

        $vehicules = DB::table('modeles')
            ->join('marques','modeles.marque_id', '=', 'marques.id')
            ->join('vehicules','modeles.id','=','vehicules.modele_id')
            ->get(['vehicules.*','modeles.libelle_m','marques.nom_m']);
        return view('vehicules.vehicules-list', compact('vehicules'));
    }

    public function showAddPage(){
        $modeles = Modele::join('marques','modeles.marque_id','=','marques.id')->get(['modeles.*','marques.*']);
        $types_moteurs = DB::table('type_moteurs')->orderBy('libelle_tm')->get();
        $usages = DB::table('usages')->orderBy('libelle_u')->get();
        return view('vehicules.add-vehicule', compact('modeles','types_moteurs','usages'));
    }

    public function saveVehicule(VehiculeSaveRequest $request){
        $vehicule = new Vehicule();
        $vehicule->numero_chassis = $request->numero_chassis;
        $vehicule->immatriculation = $request->immatriculation;
        $vehicule->nbre_places = $request->nbre_places;
        $vehicule->date_acquisition = $request->date_acquisition;
        $vehicule->prix_acquisition = $request->prix_acquisition;
        $vehicule->consommation_de_base = $request->consommation_de_base;
        $vehicule->recette_hebdo_attendue = $request->recette_hebdo_attendue;
        $vehicule->modele_id = $request->modele;
        $vehicule->type_moteur_id = $request->type_moteur;
        $vehicule->usage_id = $request->usage;

        $query = $vehicule->save();

        if ($query) {
            return redirect()->route('get.vehicule.details', ['id' => $vehicule->id])->with('success','Le véhicule a bien été enregistré !');
        } else {
            return back()->with('fail',"Quelque chose s'est mal passé");
        }

    }

    public function getVehiculeDetails($id){
        $vehicule = Modele::join('marques','modeles.marque_id', '=', 'marques.id')
            ->join('vehicules','modeles.id','=','vehicules.modele_id')
            ->join('usages','vehicules.usage_id','=','usages.id')
            ->join('type_moteurs','vehicules.type_moteur_id','=','type_moteurs.id')
            ->where('vehicules.id',$id)
            ->get(['vehicules.*','modeles.libelle_m','marques.nom_m','usages.libelle_u','type_moteurs.libelle_tm']);

        $conducteur = Vehicule::join('affectations','vehicules.id','=','affectations.vehicule_id')
            ->join('conducteurs','affectations.conducteur_id','=','conducteurs.id')
            ->latest('affectations.date_realisation')
            ->where('vehicules.id',$id)
            ->where('affectations.date_fin',null)
            ->get(['affectations.conducteur_id','conducteurs.nom_c','conducteurs.prenom_c']);
        return view('vehicules.details-vehicule', compact('vehicule','conducteur'));
    }

    public function getAffectedConducteur($id){
        $conducteur = Vehicule::join('affectations','vehicules.id','=','affectations.vehicule_id')
            ->join('conducteurs','affectations.conducteur_id','=','conducteurs.id')
            ->latest('affectations.date_realisation')
            ->where('vehicules.id', $id)
            ->whereNull('affectations.date_fin')
            ->get(['affectations.conducteur_id','conducteurs.nom_c','conducteurs.prenom_c']);
            // ->get(['affectations.conducteur_id','conducteurs.nom_c','conducteurs.prenom_c']);

        // return response()->json($conducteur);
        return compact('conducteur');
        // return $conducteur;
    }

    public function showEditPage($id){
        $vehicule = Vehicule::find($id);
        $modeles = Modele::join('marques','modeles.marque_id','=','marques.id')->get(['modeles.*','marques.*']);
        $types_moteurs = DB::table('type_moteurs')->orderBy('libelle_tm')->get();
        $usages = DB::table('usages')->orderBy('libelle_u')->get();
        return view('vehicules.edit-vehicule', compact('vehicule','modeles','types_moteurs','usages'));
    }

    public function updateVehicule(VehiculeUpdateRequest $request){
        $vehicule = Vehicule::find($request->vid);

        $vehicule->numero_chassis = $request->numero_chassis;
        $vehicule->immatriculation = $request->immatriculation;
        $vehicule->nbre_places = $request->nbre_places;
        $vehicule->date_acquisition = $request->date_acquisition;
        $vehicule->prix_acquisition = $request->prix_acquisition;
        $vehicule->consommation_de_base = $request->consommation_de_base;
        $vehicule->recette_hebdo_attendue = $request->recette_hebdo_attendue;
        $vehicule->modele_id = $request->modele;
        $vehicule->type_moteur_id = $request->type_moteur;
        $vehicule->usage_id = $request->usage;

        $query = $vehicule->save();

        if ($query) {
            return redirect()->route('get.vehicule.details', ['id' => $vehicule->id]);
        } else {
            return back()->with('fail',"Quelque chose s'est mal passé");
        }
    }

    public function deleteVehicule($id){
        $affected = Affectation::where('vehicule_id', $id)
                        ->whereNull('date_fin')
                        ->count();

        if ($affected == 0) {
            $vehicule = Vehicule::find($id);
            $query = $vehicule->delete();
            if (!$query) {
                return back()->with('fail',"Quelque chose s'est mal passé");
            } else {
                return back()->with('success',"Le véhicule a été supprimé");
            }
        } else {
            return back()->with('fail',"Le véhicule est affecté à un conducteur. Veuillez désactiver l'affectation avant de supprimer le véhicule");
            // return redirect()->route('users.index')->with('success', 'User Deleted successfully.');
        }

    }
}
