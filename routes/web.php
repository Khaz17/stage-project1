<?php

use App\Http\Controllers\ConducteurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeMoteursController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ModeleController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\AffectationController;
use App\Http\Controllers\BilanJournalierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/typesmoteurs-list',[TypeMoteursController::class, 'index'])->name('typesmoteurs.list');
Route::post('/ajout-typemoteur', [TypeMoteursController::class, 'addTypemoteur'])->name('add.typemoteur');
Route::get('/getTypemoteursList',[TypeMoteursController::class, 'getTypemoteursList'])->name('get.typemoteurs.list');
Route::get('/getTypemoteurDetails',[TypeMoteursController::class, 'getTypemoteurDetails'])->name('get.typemoteur.details');
Route::post('/updateTypemoteur',[TypeMoteursController::class, 'updateTypemoteur'])->name('update.typemoteur.details');
Route::post('/deleteTypemoteur',[TypeMoteursController::class, 'deleteTypemoteur'])->name('delete.typemoteur');


Route::get('/marques-list',[MarqueController::class, 'index'])->name('marques.list');
Route::post('/ajout-marque', [MarqueController::class, 'addMarque'])->name('add.marque');
Route::get('/getMarquesList',[MarqueController::class, 'getMarquesList'])->name('get.marques.list');
Route::get('/getMarqueDetails',[MarqueController::class, 'getMarqueDetails'])->name('get.marque.details');
Route::post('/updateMarque',[MarqueController::class, 'updateMarque'])->name('update.marque.details');
Route::post('/deleteMarque',[MarqueController::class, 'deleteMarque'])->name('delete.marque');

Route::get('/modeles-list',[ModeleController::class, 'index'])->name('modeles.list');
Route::post('/ajout-modele', [ModeleController::class, 'addModele'])->name('add.modele');
Route::get('/getModelesList',[ModeleController::class, 'getModelesList'])->name('get.modeles.list');
Route::get('/getModeleDetails',[ModeleController::class, 'getModeleDetails'])->name('get.modele.details');
Route::post('/updateModele',[ModeleController::class, 'updateModele'])->name('update.modele.details');
Route::post('/deleteModele',[ModeleController::class, 'deleteModele'])->name('delete.modele');

Route::get('/conducteurs-list',[ConducteurController::class, 'index'])->name('conducteurs.list');
Route::get('/newConducteur',[ConducteurController::class, 'showAddPage'])->name('new.conducteur');
Route::get('/editConducteur/{id}',[ConducteurController::class, 'showEditPage'])->name('edit.conducteur');
Route::post('/save-conducteur', [ConducteurController::class, 'saveConducteur'])->name('save.conducteur');
Route::get('/getConducteurDetails/{id}',[ConducteurController::class, 'getConducteurDetails'])->name('get.conducteur.details');
Route::post('/updateConducteur',[ConducteurController::class, 'updateConducteur'])->name('update.conducteur.details');
Route::post('/deleteConducteur/{id}',[ConducteurController::class, 'deleteConducteur'])->name('delete.conducteur');

Route::get('/vehicules-list',[VehiculeController::class, 'index'])->name('vehicules.list');
Route::get('/newVehicule',[VehiculeController::class, 'showAddPage'])->name('new.vehicule');
Route::get('/editVehicule/{id}',[VehiculeController::class, 'showEditPage'])->name('edit.vehicule');
Route::post('/save-vehicule', [VehiculeController::class, 'saveVehicule'])->name('save.vehicule');
Route::get('/getVehiculeDetails/{id}',[VehiculeController::class, 'getVehiculeDetails'])->name('get.vehicule.details');
Route::get('/getAffectedConducteur/{id}',[VehiculeController::class, 'getAffectedConducteur'])->name('get.affected.conducteur');

Route::post('/updateVehicule',[VehiculeController::class, 'updateVehicule'])->name('update.vehicule.details');
Route::post('/deleteVehicule/{id}',[VehiculeController::class, 'deleteVehicule'])->name('delete.vehicule');

Route::get('/affectations-list',[AffectationController::class, 'index'])->name('affectations.list');
Route::get('/newAffectation',[AffectationController::class, 'showAddPage'])->name('new.affectation');
Route::get('/editAffectation/{id}',[AffectationController::class, 'showEditPage'])->name('edit.affectation');
Route::post('/save-affectation', [AffectationController::class, 'saveAffectation'])->name('save.affectation');
Route::get('/getAffectationDetails/{id}',[AffectationController::class, 'getAffectationDetails'])->name('get.affectation.details');
Route::post('/updateAffectation',[AffectationController::class, 'updateAffectation'])->name('update.affectation.details');
Route::post('/disableAffectation/{id}',[AffectationController::class, 'disableAffectation'])->name('disable.affectation');


Route::get('/dates-bilansjournaliers-list',[BilanJournalierController::class, 'indexDates'])->name('dates.bilansjournaliers.list');
Route::get('/vehicules-bilansjournaliers-list/{date}',[BilanJournalierController::class, 'indexVehicules'])->name('vehicules.bilansjournaliers.list');
Route::get('/newBilanjournalier',[BilanJournalierController::class, 'showAddPage'])->name('new.bilanjournalier');
Route::post('/infoNewBilanjournalier',[BilanJournalierController::class, 'showNewInfoPage'])->name('info.bilanjournalier');
Route::get('/editBilanjournalier/{id}',[BilanJournalierController::class, 'showEditPage'])->name('edit.bilanjournalier');
Route::post('/save-bilanjournalier', [BilanJournalierController::class, 'saveBilanjournalier'])->name('save.bilanjournalier');
Route::get('/getBilanJournalierDetails/{id}',[BilanJournalierController::class, 'getBilanjournalierDetails'])->name('get.bilanjournalier.details');
Route::post('/updateBilanjournalier',[BilanJournalierController::class, 'updateBilanjournalier'])->name('update.bilanjournalier.details');
Route::post('/deleteBilanjournalier/{id}',[BilanJournalierController::class, 'deleteBilanjournalier'])->name('delete.bilanjournalier');


// Example Routes
Route::view('/', 'landing');
Route::match(['get', 'post'], '/dashboard', function(){
    return view('dashboard');
});
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');


