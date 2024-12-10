<?php

use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\PartitsController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('equips', EquipController::class);
Route::resource('estadis', EstadiController::class);
Route::resource('jugadors', JugadorController::class);
Route::resource('partits', PartitsController::class);

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
