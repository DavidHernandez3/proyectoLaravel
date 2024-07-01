@extends('layouts.app')

@section('content')
    <h1>Eliminar estudiante grupo</h1>
    <form action="{{ route('estudiantes_grupos.destroy', $estudianteGrupo->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="estudiante_nombre" class="form-label">Estudiante</label>
                <input type="text" class="form-control" id="estudiante_nombre"
                    value=" {{ $estudianteGrupo->estudiante->nombre }} {{ $estudianteGrupo->estudiante->apellido }}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="grupo_nombre" class="form-label">Grupo</label>
                <input type="text" class="form-control" id="grupo_nombre" value=" {{ $estudianteGrupo->grupo->nombre }}"
                    disabled>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Eliminar</button>
                <a href="{{ route('estudiantes_grupos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
