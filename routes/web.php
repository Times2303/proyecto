<?php

use App\Http\Controllers\PersonasController;
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