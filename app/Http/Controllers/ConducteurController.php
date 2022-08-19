<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConducteurSaveRequest;
use App\Http\Requests\ConducteurUpdateRequest;
use App\Models\Affectation;
use App\Models\BilanJournalier;
use App\Models\Conducteur;
use Carbon\Carbon;
use DataTables;
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
            return back()->with('fail','Conducteur déjà enregistré');
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
                $scans = $request->scan_permis;
                foreach ($scans as $scan) {
                    $fileUrl = $scan;
                    $fileNameToStore = uniqid().'_' .date('Ymd_His').'.'.$fileUrl->getClientOriginalExtension();
                    $destinationPath = public_path('uploads/conducteurs/');
                    $upload = $fileUrl->move($destinationPath, $fileNameToStore); //Ajouter scan
                    $data[] = $fileNameToStore;
                }
                $conducteur->scan_permis = json_encode($data);
                $query = $conducteur->save();
            }

            if ($upload) {

                if ($query) {
                    return redirect()->route('get.conducteur.details', ['id' => $conducteur->id])->with('success', 'Le nouveau conducteur a été enregistré');
                } else {
                    return back()->with('fail',"Quelque chose s'est mal passé");
                }

            } else {
                return back()->with('fail',"Quelque chose s'est mal passé");
            }

        }

    }

    public function getConducteurDetails($id){
        $conducteur = Conducteur::find($id);

        $vehicule = Conducteur::join('affectations','conducteurs.id','=','affectations.conducteur_id')
                                ->join('vehicules','affectations.vehicule_id','=','vehicules.id')
                                ->latest('affectations.date_realisation')
                                ->where('conducteurs.id',$conducteur->id)
                                ->where('affectations.date_fin',null)
                                ->get(['affectations.vehicule_id','vehicules.immatriculation']);

        $gg = BilanJournalier::where('conducteur_id', $id)
                            ->sum('recette_journaliere');

        $conducteur->scan_permis = json_decode($conducteur->scan_permis);
        return view('conducteurs.details-conducteur', compact('conducteur','vehicule','gg'));
        // return view('conducteurs.test', compact('conducteur','vehicule'));
    }

    public function showEditPage($id){
        $conducteur = Conducteur::find($id);
        $types_permis = DB::table('type_permis')->orderBy('nomination')->pluck('nomination');
        return view('conducteurs.edit-conducteur', compact('conducteur','types_permis'));
    }

    public function updateConducteur(ConducteurUpdateRequest $request){
        $nom_c = $request->nom_c;
        $prenom_c = $request->prenom_c;
        $id_c = $request->id;

        $check = Conducteur::where('nom_c',$nom_c)->where('prenom_c',$prenom_c)->whereNotIn('id', [$id_c])->count();

        if ($check>0) {
            return back()->with('fail','Conducteur déjà enregistré');
        } else {
            $conducteur_id = $request->cid;

            $conducteur = Conducteur::find($conducteur_id);
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
                $scans = $request->scan_permis;
                foreach ($scans as $scan) {
                    $fileUrl = $scan;
                    $fileNameToStore = uniqid().'_' .date('Ymd_His').'.'.$fileUrl->getClientOriginalExtension();
                    $destinationPath = public_path('uploads/conducteurs/');
                    $upload = $fileUrl->move($destinationPath, $fileNameToStore); //Ajouter scan
                    $data[] = $fileNameToStore;
                }
                $conducteur->scan_permis = json_encode($data);
                $query = $conducteur->save();
            }

            if ($upload) {

                if ($query) {
                    return redirect()->route('get.conducteur.details', ['id' => $conducteur->id, 'success' => 'Le nouveau conducteur a été enregistré']);
                } else {
                    return back()->with('fail',"Quelque chose s'est mal passé");
                }

            } else {
                return back()->with('fail',"Quelque chose s'est mal passé");
            }

        }
    }

    public function deleteConducteur($id){
        $affected = Affectation::where('conducteur_id', $id)
                        ->whereNull('date_fin')
                        ->count();

        if ($affected == 1) {
            return back()->with('forbid',"Le conducteur est affecté à un véhicule. Veuillez désactiver l'affectation avant de supprimer le conducteur");
        } else if ($affected == 0) {
            $conducteur = Conducteur::find($id);
            $query = $conducteur->delete();
        }

        if(!$query){
            return back()->with('fail',"Quelque chose s'est mal passé");
        } else {
            return redirect()->route('conducteurs.list')->with('success', 'Le conducteur a été supprimé');
            // return redirect()->route('users.index')->with('success', 'User Deleted successfully.');

        }

        // if (!$query) {
        //     return back()->with('fail',"Quelque chose s'est mal passé !");
        // } else {
        //     return back()->with('success',"L'affectation a été réalisée avec succès !");
        // }


    }
}
