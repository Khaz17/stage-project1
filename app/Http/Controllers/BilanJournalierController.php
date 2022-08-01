<?php

namespace App\Http\Controllers;

use App\Http\Requests\BilanJournalierSaveRequest;
use App\Http\Requests\BilanJournalierUpdateRequest;
use App\Models\BilanJournalier;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BilanJournalierController extends Controller
{
    public function index(){
        $bilansjournaliers = DB::table('bilans_journaliers')->get();
        return view('bilans-journaliers.bilans-journaliers-list', compact('bilansjournaliers'));
    }

    public function showAddPage(){
        $vehicules = DB::table('vehicules')
                            ->join('modeles','vehicules.modele_id','=','modeles.id')
                            ->join('marques','modeles.marque_id','=','marques.id')
                            ->whereIn('vehicules.id', function($query){
                                $query->selectRaw('vehicule_id')->from('affectations')->whereNull('date_fin');
                            })->get();

        return view('bilans-journaliers.add-bilanjournalier', compact('vehicules'));
        // return view('test', compact('vehicules'));
    }

    public function saveBilanjournalier(BilanJournalierSaveRequest $request){

    }

    public function getBilanjournalierDetails($id){
        $bilanjournalier = BilanJournalier::find($id);
        return view('bilans-journaliers.details-bilanjournalier', compact('bilanjournalier'));
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
