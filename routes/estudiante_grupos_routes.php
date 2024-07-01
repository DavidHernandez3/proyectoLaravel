<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteGrupoController;


Route::group(['prefix' => 'estudiantes_grupos','middleware' => 'auth_docentes'], function () {
    Route::get('/', [EstudianteGrupoController::class, 'index'])->name('estudiantes_grupos.index');
    Route::get('/show/{id}', [EstudianteGrupoController::class, 'show'])->name('estudiantes_grupos.show');
    Route::get('/create', [EstudianteGrupoController::class, 'create'])->name('estudiantes_grupos.create');
    Route::post('/create', [EstudianteGrupoController::class, 'store'])->name('estudiantes_grupos.store');
    Route::get('/edit/{id}', [EstudianteGrupoController::class, 'edit'])->name('estudiantes_grupos.edit');
    Route::post('/edi/{id}', [EstudianteGrupoController::class, 'update'])->name('estudiantes_grupos.update');
    Route::get('/delete/{id}', [EstudianteGrupoController::class, 'delete'])->name('estudiantes_grupos.delete');
    Route::post('/delete/{id}', [EstudianteGrupoController::class, 'destroy'])->name('estudiantes_grupos.destroy');
});
