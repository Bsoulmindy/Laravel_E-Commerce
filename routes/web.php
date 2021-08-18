<?php

use App\Http\Controllers\controlIndex;
use App\Http\Controllers\modifyUserInfos;
use App\Http\Controllers\panelController;
use App\Http\Controllers\purchaseController;
use App\Http\Controllers\savedCarts;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:admin,web'])->group(function () {
    Route::get('/enregistrer', [savedCarts::class, 'saveCart']);
    Route::get('/recuperer', [savedCarts::class, 'get']);
    Route::get('/achat', [purchaseController::class, 'new']);
    Route::post('/achat/verifierCarteBancaire', [purchaseController::class, 'store']);
    Route::post('/achat/storeAdresse', [purchaseController::class, 'storeAdresse']);
    Route::get('/achat/confirmer/{token}', [purchaseController::class, 'purchase']);
    Route::get('/achat/carteBancaire', function() {return view("carteBancaire");});
    Route::get('/achat/adresse', function() {return view("adresse");});
    Route::get('/profile', function() {return view("profile");});
    Route::post("/profile/applyModifications", [modifyUserInfos::class, 'modify']);
    Route::post("/profile/modifyIcon", [modifyUserInfos::class, 'modifyIcon']);
    Route::post("/profile/modifyPassword", [modifyUserInfos::class, 'modifyPassword']);
});

Route::middleware(['can:accessAdmin'])->group(function () {
    Route::get('/panel', [panelController::class, 'index']);
    Route::get('/panel/stats', [panelController::class, 'stats']);
    Route::get('/panel/resultat', [panelController::class, 'resultat']);
    Route::get('/panel/stock', [panelController::class, 'stock']);
    Route::get('/panel/utilisateurs', [panelController::class, 'utilisateurs']);
    Route::get('/panel/gestionProduits', [panelController::class, 'gestionProduits']);
    Route::get('/panel/ajouterProduits', [panelController::class, 'ajouterProduitsPage']);
    Route::post('/panel/ajouterProduits', [panelController::class, 'ajouterProduits']);
    Route::get('/panel/modifierProduits', [panelController::class, 'modifierProduitsPage']);
    Route::get('/panel/chercherProduits', [panelController::class, 'chercherProduitsGET']);
    Route::post('/panel/chercherProduits', [panelController::class, 'chercherProduitsPage']);
    Route::post('/panel/modifierProduits', [panelController::class, 'modifierProduits']);
    Route::get('/panel/enleverProduits', [panelController::class, 'enleverProduitsPage']);
    Route::post('/panel/enleverProduits', [panelController::class, 'enleverProduitsVerification']);
    Route::delete('/panel/enleverProduits', [panelController::class, 'enleverProduits']);
});

Route::get('/', function () {return view("index");});
Route::get('/produits/{categorie}', [controlIndex::class, 'show']);
Route::get('/panier', [controlIndex::class, 'panier']);
Route::post('/search', [controlIndex::class, 'search']);
Route::get('/test', function () {return view('test');});

require __DIR__.'/auth.php';