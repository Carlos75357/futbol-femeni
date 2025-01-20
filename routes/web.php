<?php

use App\Http\Controllers\CalendariController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\PartitsController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('/estadis', EstadiController::class)
        ->except(['index', 'show'])
        ->middleware([RoleMiddleware::class . ':administrador']);
    
    Route::resource('/partits', PartitsController::class)
        ->except(['index', 'show', 'create', 'store'])
        ->middleware([RoleMiddleware::class . ':arbitre']);
    
    Route::resource('/partits', PartitsController::class)->only(['index', 'show']);
});
Route::resource('/equips', EquipController::class);
Route::resource('/estadis', EstadiController::class);
Route::resource('/jugadors', JugadorController::class);
Route::resource('/calendaris', CalendariController::class);
Route::get('/historic', [PartitsController::class, 'historic'])->name('partits.historic');
Route::get('/classificacio', [PartitsController::class, 'classificacio'])->name('partits.classificacio');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

require __DIR__.'/auth.php';