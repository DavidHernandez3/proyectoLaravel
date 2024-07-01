@extends('layouts.app')

@section('content')
    <h1>Crear nuevo estudiante grupo</h1>
    <form action="{{ route('estudiantes_grupos.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="estudiante_id" class="form-label">Estudiante</label>
                <select name="estudiante_id" class="form-control" required>
                    <option value="">Seleccione un estudiante</option>
                    @foreach ($estudiantes as $estudiante)
                        <option value="{{ $estudiante->id }}">{{ $estudiante->nombre }} {{ $estudiante->apellido }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="grupo_id" class="form-label">Grupo</label>
                <select name="grupo_id" class="form-control" required>
                    <option value="">Seleccione un grupo</option>
                    @foreach ($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ route('docentes_grupos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
