<?php

use App\Http\Controllers\AlumnoController;
use Illuminate\Support\Facades\Route;

Route::prefix('alumnos')->group(function () {
    Route::get('/', [AlumnoController::class, 'index']);
    Route::get('/{id}', [AlumnoController::class, 'show'])->middleware('validate.numeric.id');
    Route::post('/', [AlumnoController::class, 'store']);
    Route::put('/{id}', [AlumnoController::class, 'update'])->middleware('validate.numeric.id');
    Route::delete('/{id}', [AlumnoController::class, 'destroy'])->middleware('validate.numeric.id');
});