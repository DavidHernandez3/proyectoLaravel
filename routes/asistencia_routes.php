<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsistenciaController;

Route::group(['prefix' => 'asistencias','middleware' => 'auth_docentes'], function(){
    Route::get('/', [AsistenciaController::class, 'index'])->name('asistencias.index');
    Route::get('/show/{id}', [AsistenciaController::class, 'show'])->name('asistencias.show');
    Route::get('/create', [AsistenciaController::class, 'create'])->name('asistencias.create');
    Route::post('/create', [AsistenciaController::class, 'store'])->name('asistencias.store');
    Route::get('/edit/{id}', [AsistenciaController::class, 'edit'])->name('asistencias.edit');
    Route::post('/edit/{id}', [AsistenciaController::class, 'update'])->name('asistencias.update');
    Route::get('/delete/{id}', [AsistenciaController::class, 'delete'])->name('asistencias.delete');
    Route::post('/delete/{id}', [AsistenciaController::class, 'destroy'])->name('asistencias.destroy');
});
