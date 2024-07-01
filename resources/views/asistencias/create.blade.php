@extends('layouts.app')

@section('content')
<h1>Crear nueva asistencia</h1>
<form action="{{route('asistencias.store')}}" method="POST">
    @csrf

    <div class="row">
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
            <label for="estudiante_pin" class="form-label">PIN</label>
            <input type="estudiante_pin" class="form-control" id="estudiante_pin" name="estudiante_pin" required>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{route('asistencias.index')}}">Cancelar</a>
        </div>
    </div>

    <div style="margin-top: 10px" class="row">
        @error('InvalidCredentials')
        <div class="alert alert-danger fade show" id="success-message" data-bs-dismiss="alert" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>
</form>

@endsection
