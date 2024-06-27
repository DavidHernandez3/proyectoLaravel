<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrupoController;


Route::group(['prefix' => 'grupos','middleware' => 'auth_docentes'], function () {
    Route::get('/', [GrupoController::class, 'index'])->name('grupos.index');
    Route::get('/show/{id}', [GrupoController::class, 'show'])->name('grupos.show');
    Route::get('/create', [GrupoController::class, 'create'])->name('grupos.create');
    Route::post('/create', [GrupoController::class, 'store'])->name('grupos.store');
    Route::get('/edit/{id}', [GrupoController::class, 'edit'])->name('grupos.edit');
    Route::post('/edi/{id}', [GrupoController::class, 'update'])->name('grupos.update');
    Route::get('/delete/{id}', [GrupoController::class, 'delete'])->name('grupos.delete');
    Route::post('/delete/{id}', [GrupoController::class, 'destroy'])->name('grupos.destroy');
});
