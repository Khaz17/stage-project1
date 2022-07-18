<?php

use App\Http\Controllers\ConducteurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeMoteursController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ModeleController;

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

Route::post('/ajout-conducteur', [ConducteurController::class, 'addConducteur'])->name('add.conducteur');
Route::get('/getConducteursList',[ConducteurController::class, 'getConducteursList'])->name('get.conducteurs.list');
Route::get('/getConducteurDetails',[ConducteurController::class, 'getConducteurDetails'])->name('get.conducteur.details');
Route::post('/updateConducteur',[ConducteurController::class, 'updateConducteur'])->name('update.conducteur.details');
Route::post('/deleteConducteur',[ConducteurController::class, 'deleteConducteur'])->name('delete.conducteur');

// Example Routes
Route::view('/', 'landing');
Route::match(['get', 'post'], '/dashboard', function(){
    return view('dashboard');
});
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');


