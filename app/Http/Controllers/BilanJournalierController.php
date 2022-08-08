<?php

namespace App\Http\Controllers;

use App\Http\Requests\BilanJournalierInfoRequest;
use App\Http\Requests\BilanJournalierSaveRequest;
use App\Http\Requests\BilanJournalierUpdateRequest;
use App\Models\BilanJournalier;
use App\Models\Vehicule;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\isNull;

class BilanJournalierController extends Controller
{
    public function indexDates(){
        $datesbilansjournaliers = DB::table('bilans_journaliers')
                    ->selectRaw('count(id) as nbj, date_bilan')
                    ->groupBy('date_bilan')
                    ->get();
        return view('bilans-journaliers.dates-bilans-journaliers', compact('datesbilansjournaliers'));
    }

    public function indexVehicules($date){
        $vehiculesbilansjournaliers = BilanJournalier::join('vehicules','bilans_journaliers.vehicule_id','=','vehicules.id')
                                        ->where('date_bilan', $date)
                                        ->get(['bilans_journaliers.*','vehicules.immatriculation']);
        return view('bilans-journaliers.vehicules-bilans-journaliers', compact('vehiculesbilansjournaliers'));
    }

    // public function getBilanjournalierDetails($date, $immatriculation){
    //     $bilanjournalier = DB::table('bilans_journaliers')
    //                             ->whereIn('date_bilan', $date)
    //                             ->whereIn('immatriculation', $immatriculation)
    //                             ->join('vehicules','bilans_journaliers.vehicule_id','=','vehicules.id')
    //                             ->join('conducteurs','bilans_journaliers.conducteur_id','=','conducteurs.id')
    //                             ->get();
    //     return view('bilans-journaliers.details-bilanjournalier', compact('bilanjournalier'));
    // }

    public function getBilanjournalierDetails($id){
        $bilanjournalier = BilanJournalier::join('vehicules','bilans_journaliers.vehicule_id','=','vehicules.id')
                                ->join('conducteurs','bilans_journaliers.conducteur_id','=','conducteurs.id')
                                ->where('bilans_journaliers.id',$id)
                                ->get(['bilans_journaliers.*','vehicules.immatriculation','conducteurs.nom_c','conducteurs.prenom_c']);
        return $bilanjournalier[0];
    }


    public function showAddPage(){
        $vehicules = DB::table('vehicules')
                            ->join('modeles','vehicules.modele_id','=','modeles.id')
                            ->join('marques','modeles.marque_id','=','marques.id')
                            ->whereIn('vehicules.id', function($query){
                                $query->selectRaw('vehicule_id')->from('affectations')->whereNull('date_fin');
                            })->get(['vehicules.id','vehicules.immatriculation','marques.nom_m','modeles.libelle_m']);

        return view('bilans-journaliers.set-date-vehicule-bilanjournalier', compact('vehicules'));
        // return view('test', compact('vehicules'));
    }

    public function showNewInfoPage(BilanJournalierInfoRequest $request){

        $id = $request->vehicule;
        $date = $request->date_bilan;
        $idc = $request->conducteur;
        $vehicule = Vehicule::find($id);

        $check = BilanJournalier::where('vehicule_id',$id)
                                ->where('date_bilan',$date)
                                ->count();

        if ($check > 0) {
            return back()->with('fail',"Ce bilan a déjà été enregistré pour cette voiture !");
        } else {

            $ddate = Carbon::parse($date);
            $week = $ddate->weekOfYear;

            $recette_hebdo = BilanJournalier::where('vehicule_id', $id)
                                            ->whereBetween('date_bilan', [$ddate->startOfWeek()->format('Y-m-d'), $ddate->endOfWeek()->format('Y-m-d')])
                                            ->sum('recette_journaliere');

            $postbj = BilanJournalier::select('kilometrage','date_bilan')
                                        ->where('vehicule_id',$id)
                                        ->where('date_bilan','>', $date)
                                        ->latest('date_bilan')
                                        ->first();

            $prebj = BilanJournalier::select('kilometrage','date_bilan')
                                    ->where('vehicule_id',$id)
                                    ->where('date_bilan','<', $date)
                                    ->latest('date_bilan')
                                    ->first();

            if ($postbj != null) {
                return back()->with('forbidden',"Vous ne pouvez pas effectuer un bilan pour le véhicule s'il en existe un pour une date plus récente");
            } else {
                return view('bilans-journaliers.add-bilanjournalier', compact('vehicule','date','idc','recette_hebdo','prebj'));
            }

        }
    }

    public function saveBilanjournalier(BilanJournalierSaveRequest $request){

        $prebj = BilanJournalier::select('kilometrage','date_bilan')
                                    ->where('vehicule_id', $request->vehicule)
                                    ->where('date_bilan','<', $request->date_bilan)
                                    ->latest('date_bilan')
                                    ->first();


        if ($prebj->count() > 0 && $prebj->kilometrage >= $request->kilometrage) {
            return redirect()->route('new.bilanjournalier')->with('fail',"Le kilométrage doit avoir une valeur supérieure à celle du kilométrage du dernier bilan");
        } else {
            $bilanjournalier = new BilanJournalier();
            $bilanjournalier->kilometrage = $request->kilometrage;
            $bilanjournalier->qte_essence_consommee = $request->qte_essence_consommee;
            $bilanjournalier->recette_journaliere = $request->recette_journaliere;
            $bilanjournalier->date_bilan = $request->date_bilan;
            $bilanjournalier->vehicule_id = $request->vehicule;
            $bilanjournalier->conducteur_id = $request->conducteur;
            $query = $bilanjournalier->save();

            if (!$query) {
                return redirect()->route('new.bilanjournalier')->with('fail',"Quelque chose s'est mal passé !");
            } else {
                return redirect()->route('vehicules.bilansjournaliers.list', ['date' => $bilanjournalier->date_bilan])->with('success',"Le bilan a été enregistré avec succès !");
            }
        }

    }

    public function showEditPage($id){
        $bilanjournalier = BilanJournalier::find($id);
        $vehicules = DB::table('vehicules')
                        ->join('modeles','vehicules.modele_id','=','modeles.id')
                        ->join('marques','modeles.marque_id','=','marques.id')
                        ->whereIn('vehicules.id', function($query){
                            $query->selectRaw('vehicule_id')->from('affectations')->whereNull('date_fin');
                        })->get();
        return view('bilans-journaliers.edit-bilanjournalier', compact('bilanjournalier','vehicule'));
    }

    public function updateBilanjournalier(BilanJournalierUpdateRequest $request){

    }

    public function deleteBilanjournalier($id){
        $bilanjournalier = BilanJournalier::find($id);
        $query = $bilanjournalier->delete();

        if ($query) {
            return back()->with('success', 'Le bilan a été supprimé !');
        } else {
            return back()->with('fail', "Quelque chose s'est mal passé !");
        }

    }
}
