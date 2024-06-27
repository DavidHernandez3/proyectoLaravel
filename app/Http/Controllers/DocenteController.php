<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('docentes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        $docente = Docente::create($request->all());
        return redirect()->route('docentes.index')->with('success', 'Docente creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return abort(404);
        }

        return view('docentes.show', compact('docente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return abort(404);
        }
        return view('docentes.edit', compact('docente'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    public function delete($id)
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return abort(404);
        }
        return view('docentes.delete', compact('docente'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return abort(404);
        }

        $docente->delete();

        return redirect()->route('docentes.index')->with('success', 'Docente eliminado correctamente.');
    }

    public function showLoginForm()
    {
        return view('docentes.login');
    }

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

    public function logout()
    {
        Auth::guard('docente')->logout();
        return redirect()->route('docentes.showLoginForm');
    }
}
