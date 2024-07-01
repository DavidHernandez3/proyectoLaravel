@extends('layouts.app')

@section('content')
    <h1>Detalles de la Asistencia</h1>
    <div class="row">
        <div class="row">
            <div class="col-md-8">
                <label for="estudiante_nombre"class="form-label">Estudiante</label>
                <input type="text" id="estudiante_nombre" class="form-control" value="{{ $estudiante->nombre }} {{ $estudiante->apellido }}" disabled>
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
            <a href="{{ route('asistencias.index') }}" class="btn btn-primary p-2 m-2">Regresar</a>
        </div>
    </div>
@endsection
