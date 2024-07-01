<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Asistencia;
use App\Models\EstudianteGrupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    /* Acción que Muestra una lista del recurso. */
    public function index(Request $request)
    {
        $query = Estudiante::query();

        if ($request->has('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->has('apellido')) {
            $query->where('apellido', 'like', '%' . $request->apellido . '%');
        }
        $estudiantes = $query->orderBy('id', 'desc')->simplePaginate(10);

        return view('estudiantes.index', compact('estudiantes'));
    }

    /* Acción que Muestra el formulario para crear un nuevo recurso. */
    public function create()
    {
        return view('estudiantes.create');
    }

    /* Acción que Almacena un recurso recién creado en el almacenamiento. */
    public function store(Request $request)
    {
        $request->merge(['pin' => Hash::make($request->pin)]);
        $estudiante = Estudiante::create($request->all());
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante creado correctamente.');
    }

    /* Acción que Muestra el recurso especificado. */
    public function show($id)
    {
        $estudiante = Estudiante::find($id);
        if(!$estudiante){
            return abort(404);
        }

        return view('estudiantes.show', compact('estudiante'));
    }

    /* Acción que Muestra el formulario para editar el recurso especificado. */
    public function edit($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return abort(404);
        }
        return view('estudiantes.edit', compact('estudiante'));
    }

    /* Acción que actualiza el recurso especificado en el almacenamiento. */
    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return abort(404);
        }

        $estudiante->nombre = $request->nombre;
        $estudiante->apellido = $request->apellido;
        $estudiante->email = $request->email;

        $estudiante->save();

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado correctamente.');
    }

    /* Acción que muestra la vista para eliminar un recurso específico */
    public function delete($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return abort(404);
        }
        return view('estudiantes.delete', compact('estudiante'));
    }

    /* Acción que Elimina el recurso especificado del almacenamiento. */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $estudiante = Estudiante::find($id);

            if (!$estudiante) {
                return abort(404);
            }

            Asistencia::where('estudiante_id', $estudiante->id)->delete();
            EstudianteGrupo::where('estudiante_id', $estudiante->id)->delete();
            $estudiante->delete();

            DB::commit();

            return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('estudiantes.index')->withErrors([
                'error' => 'Ha ocurrido un error al eliminar al estudiante.',
            ]);
        }
    }


}
