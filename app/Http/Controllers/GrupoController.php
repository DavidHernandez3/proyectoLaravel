<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\DocenteGrupo;
use App\Models\Asistencia;
use App\Models\EstudianteGrupo;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrupoController extends Controller
{
    /* Acción que muestra la página principal para administrar grupos */
    public function index(Request $request)
    {
        $query = Grupo::query();

        if($request->has('nombre')){
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        $grupos = $query->orderBy('id', 'desc')->simplePaginate(10);
        return view('grupos.index', compact('grupos'));
    }

    /* Accion que muestra el formulario para crear un nuevo grupo */
    public function create()
    {
        return view('grupos.create');
    }

    /* Acción que recibe los datos del formulario y los envía a la bd */
    public function store(Request $request)
    {
        $grupo = Grupo::create($request->all());
        return redirect()->route('grupos.index')->with('success', 'Grupo creado correctamente');
    }

    /* Acción que permite mostrar el detalle de un grupo */
    public function show($id)
    {
        $grupo = Grupo::find($id);
        if(!$grupo){
            return abort(404);
        }

        return view('grupos.show', compact('grupo'));
    }

    /* Acción que muestra los datos de un grupo para modificar */
    public function edit($id)
    {
        $grupo = Grupo::find($id);
        if(!$grupo){
            return abort(404);
        }

        return view('grupos.edit', compact('grupo'));
    }

    /* Acción que recibe los datos modificados y los envía a la bd */
    public function update(Request $request, $id)
    {
        $grupo = Grupo::find($id);
        if(!$grupo){
            return abort(404);
        }

        $grupo->nombre = $request->nombre;
        $grupo->descripcion = $request->descripcion;

        $grupo->save();

        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado correctamente');
    }

    /* Acción que muestra los detalles del grupo para confirmar la eliminación */
    public function delete($id){
        $grupo = Grupo::find($id);
        if(!$grupo){
            return abort(404);
        }

        return view('grupos.delete', compact('grupo'));
    }

    /* Acción que recibe la confirmación y elimina el registro en la bd */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $grupo = Grupo::find($id);

            if (!$grupo) {
                return abort(404);
            }

            Asistencia::where('grupo_id', $grupo->id)->delete();
            DocenteGrupo::where('grupo_id', $grupo->id)->delete();
            EstudianteGrupo::where('grupo_id', $grupo->id)->delete();
            $grupo->delete();
            DB::commit();

            return redirect()->route('grupos.index')->with('success', 'Grupo eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('grupos.index')->with('danger', 'No se pudo eliminar el grupo');
        }
    }
}
