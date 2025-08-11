<?php

use App\Http\Controllers\ParroquiasController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\SacerdotesController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('principal');
})->name('principal');

// Rutas para PERSONAS
Route::get('/personas', [PersonasController::class, 'index'])->name('personas.index');
Route::get('/personas/create', [PersonasController::class, 'create'])->name('personas.create');
Route::post('/personas/store', [PersonasController::class, 'store'])->name('personas.store');
Route::get('/personas/{persona}/edit', [PersonasController::class, 'edit'])->name('personas.edit');
Route::put('/personas/{persona}', [PersonasController::class, 'update'])->name('personas.update');
Route::delete('/personas/{persona}', [PersonasController::class, 'destroy'])->name('personas.destroy');

//Rutas para SACERDOTES
Route::get('/sacerdotes', [SacerdotesController::class, 'index'])->name('sacerdotes.index');
Route::get('/sacerdotes/seleccionar', [SacerdotesController::class, 'seleccionar'])->name('sacerdotes.seleccionar');
Route::get('/sacerdotes/create', [SacerdotesController::class, 'create'])->name('sacerdotes.create');
Route::post('/sacerdotes/store', [SacerdotesController::class, 'store'])->name('sacerdotes.store');
Route::get('/sacerdotes/{sacerdote}/edit', [SacerdotesController::class, 'edit'])->name('sacerdotes.edit');
Route::put('/sacerdotes/{sacerdote}', [SacerdotesController::class, 'update'])->name('sacerdotes.update');
Route::delete('/sacerdotes/{sacerdote}', [SacerdotesController::class, 'destroy'])->name('sacerdotes.destroy');

// Rutas para PARROQUIAS
Route::get('/parroquias', [ParroquiasController::class, 'index'])->name('parroquias.index');
Route::get('/parroquias/create', [ParroquiasController::class, 'create'])->name('parroquias.create');
Route::post('/parroquias/store', [ParroquiasController::class, 'store'])->name('parroquias.store');
Route::get('/parroquias/{parroquia}/edit', [ParroquiasController::class, 'edit'])->name('parroquias.edit');
Route::put('/parroquias/{parroquia}', [ParroquiasController::class, 'update'])->name('parroquias.update');
Route::delete('/parroquias/{parroquia}', [ParroquiasController::class, 'destroy'])->name('parroquias.destroy');
