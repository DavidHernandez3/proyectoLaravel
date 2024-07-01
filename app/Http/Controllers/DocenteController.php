<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\DocenteGrupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    /* Acción que Muestra una lista del recurso. */
    public function index(Request $request)
    {
        $query = Docente::query();

        if ($request->has('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->has('apellido')) {
            $query->where('apellido', 'like', '%' . $request->apellido . '%');
        }
        $docentes = $query->orderBy('id', 'desc')->simplePaginate(10);

        return view('docentes.index', compact('docentes'));
    }

    /* Acción que Muestra el formulario para crear un nuevo recurso. */
    public function create()
    {
        return view('docentes.create');
    }

    /* Acción que Almacena un recurso recién creado en el almacenamiento. */
    public function store(Request $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        $docente = Docente::create($request->all());
        return redirect()->route('docentes.index')->with('success', 'Docente creado correctamente.');
    }

    /* Acción que Muestra el recurso especificado. */
    public function show($id)
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return abort(404);
        }

        return view('docentes.show', compact('docente'));
    }

    /* Acción que Muestra el formulario para editar el recurso especificado. */
    public function edit($id)
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return abort(404);
        }
        return view('docentes.edit', compact('docente'));
    }

    /* Acción que actualiza el recurso especificado en el almacenamiento. */
    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return abort(404);
        }

        $docente->nombre = $request->nombre;
        $docente->apellido = $request->apellido;
        $docente->email = $request->email;

        $docente->save();

        return redirect()->route('docentes.index')->with('success', 'Docente actualizado correctamente.');
    }

    /* Acción que muestra la vista para eliminar un recurso específico */
    public function delete($id)
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return abort(404);
        }
        return view('docentes.delete', compact('docente'));
    }

    /* Acción que Elimina el recurso especificado del almacenamiento. */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $docente = Docente::find($id);

            if (!$docente) {
                return abort(404);
            }

            DocenteGrupo::where('docente_id', $docente->id)->delete();
            $docente->delete();
            DB::commit();

            return redirect()->route('docentes.index')->with('success', 'Docente eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('docentes.index')->withErrors([
                'error' => 'Ha ocurrido un error al eliminar al docente.',
            ]);
        }
    }

    /* Acción que muestra la vista del formulario de inicio de sesión del docente */
    public function showLoginForm()
    {
        return view('docentes.login');
    }

    /* Acción que maneja el inicio de sesión de un docente */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('docente')->attempt($credentials)) {
            return redirect()->intended();
        }

        return redirect()->back()->withErrors([
            'InvalidCredentials' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    /* Acción que cierra la sesión del docente */
    public function logout()
    {
        Auth::guard('docente')->logout();
        return redirect()->route('docentes.showLoginForm');
    }
}
