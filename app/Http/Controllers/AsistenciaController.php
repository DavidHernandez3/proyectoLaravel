<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Estudiante;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Asistencia::query();

        if ($request->has('fecha')) {
            $query->where('fecha', 'like', '%' . $request->fecha . '%');
        }

        if ($request->has('hora_entrada')) {
            $query->where('hora_entrada', 'like', '%' . $request->hora_entrada . '%');
        }

        $asistencias = $query->with('estudiante', 'grupo')->orderBy('id', 'desc')->simplePaginate(10);

        return view('asistencias.index', compact('asistencias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();
        return view('asistencias.create',compact('estudiantes','grupos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validar que el estudiante seleccionado existe
    $estudiante = Estudiante::find($request->estudiante_id);
    if (!$estudiante) {
        return redirect()->back()->withErrors([
            'InvalidCredentials' => 'El estudiante seleccionado no existe.',
        ]);
    }

    if (!Hash::check($request->estudiante_pin, $estudiante->pin)) {
        return redirect()->back()->withErrors([
            'InvalidCredentials' => 'El PIN del estudiante no coincide.',
        ]);
    }


    $asistencia = Asistencia::create([
        'fecha' => $request->fecha,
        'hora_entrada' => $request->hora_entrada,
        'estudiante_id' => $request->estudiante_id,
        'grupo_id' => $request->grupo_id,
    ]);

    return redirect()->route('asistencias.index')->with('success', 'Asistencia creada correctamente.');
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $asistencia = Asistencia::find($id);
        $estudiante = Estudiante::find($asistencia->estudiante_id);
        if(!$asistencia || !$estudiante){
            return abort(404);
        }

        return view('asistencias.show', compact('asistencia', 'estudiante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($id)
    // {
    //     $asistencia = Asistencia::find($id);
    //     if(!$asistencia){
    //         return abort(404);
    //     }

    //     return view('asistencias.edit', compact('asistencia'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $grupo = Asistencia::find($id);
    //     if(!$grupo){
    //         return abort(404);
    //     }

    //     $grupo->nombre = $request->nombre;
    //     $grupo->descripcion = $request->descripcion;

    //     $grupo->save();

    //     return redirect()->route('asistencias.index')->with('success', 'Asistencia actualizado correctamente');
    // }

    /* Acción que muestra los detalles del grupo para confirmar la eliminación */
    public function delete($id){
        $asistencia = Asistencia::find($id);
        $estudiante = Estudiante::find($asistencia->estudiante_id);
        if(!$asistencia || !$estudiante){
            return abort(404);
        }

        return view('asistencias.delete', compact('asistencia', 'estudiante'));
    }

    /* Acción que recibe la confirmación y elimina el registro en la bd */
    public function destroy($id)
    {
        $asistencia = Asistencia::find($id);
        if(!$asistencia){
            return abort(404);
        }

        $asistencia->delete();
        return redirect()->route('asistencias.index')->with('success', 'Asistencia eliminada correctamente');
    }
}
