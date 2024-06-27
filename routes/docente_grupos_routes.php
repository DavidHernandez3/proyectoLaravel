<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocenteGrupoController;


Route::group(['prefix' => 'docentes_grupos','middleware' => 'auth_docentes'], function () {
    Route::get('/', [DocenteGrupoController::class, 'index'])->name('docentes_grupos.index');
    Route::get('/show/{id}', [DocenteGrupoController::class, 'show'])->name('docentes_grupos.show');
    Route::get('/create', [DocenteGrupoController::class, 'create'])->name('docentes_grupos.create');
    Route::post('/create', [DocenteGrupoController::class, 'store'])->name('docentes_grupos.store');
    Route::get('/edit/{id}', [DocenteGrupoController::class, 'edit'])->name('docentes_grupos.edit');
    Route::post('/edi/{id}', [DocenteGrupoController::class, 'update'])->name('docentes_grupos.update');
    Route::get('/delete/{id}', [DocenteGrupoController::class, 'delete'])->name('docentes_grupos.delete');
    Route::post('/delete/{id}', [DocenteGrupoController::class, 'destroy'])->name('docentes_grupos.destroy');
});
