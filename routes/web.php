<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\AchatController;
use App\Http\Controllers\FinanceController;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('produits', ProduitController::class);
Route::resource('finance', FinanceController::class);
Route::resource('achats', AchatController::class);
Route::resource('ventes', VenteController::class);