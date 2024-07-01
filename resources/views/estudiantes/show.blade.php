@extends('layouts.app')

@section('content')
    <h1>Detalles del estudiante</h1>
    <div class="row">
        <div class="col-md-4">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $estudiante->nombre }}" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="apellido" class="form-label">Descripción</label>
            <input type="text" name="apellido" id="apellido" class="form-control" value="{{ $estudiante->apellido }}" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="email" class="form-label">Correo</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ $estudiante->email }}" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('estudiantes.index') }}" class="btn btn-primary p-2 m-2">Regresar</a>
        </div>
    </div>
@endsection
