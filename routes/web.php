<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeMoteursController;

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


// Example Routes
Route::view('/', 'landing');
Route::match(['get', 'post'], '/dashboard', function(){
    return view('dashboard');
});
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');


