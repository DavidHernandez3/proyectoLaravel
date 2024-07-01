@extends('layouts.app')

@section('content')
<h1>Eliminar asistencia</h1>
<form action="{{route('asistencias.destroy', $asistencia->id)}}" method="POST">
    @csrf

    <div class="row">
        <div class="row">
            <div class="col-md-8">
                <label class="form-label">Estudiante</label>
                <input type="text" class="form-control" value="{{ $estudiante->nombre . ' ' . $estudiante->apellido }}" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $asistencia->fecha }}" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="hora_entrada" class="form-label">Hora de Entrada</label>
            <input type="time" name="hora_entrada" id="hora_entrada" class="form-control" value="{{ $asistencia->hora_entrada }}" disabled>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-danger">Eliminar</button>
            <a href="{{route('asistencias.index')}}">Cancelar</a>
        </div>
    </div>
</form>

@endsection
