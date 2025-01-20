<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EquipController;
use App\Http\Controllers\Api\EstadiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JugadorController;
use App\Http\Controllers\Api\PartitsController;

Route::apiResource('jugadores', JugadorController::class)->middleware('api');
Route::apiResource('equips', EquipController::class)->middleware('api');
Route::apiResource('estadis', EstadiController::class)->middleware('api');
Route::apiResource('partits', PartitsController::class)->middleware('api');

Route::post('login', [AuthController::class, 'login'])->middleware('api');
Route::post('register', [AuthController::class, 'register'])->middleware('api');


Route::middleware(['auth:sanctum','api'])->group( function () {
    Route::apiResource('jugadores',  JugadorController::class);
    Route::apiResource('equips',  EquipController::class);
    Route::apiResource('estadis',  EstadiController::class);
    Route::apiResource('partits',  PartitsController::class);
    Route::post('logout', [AuthController::class, 'logout']);

});