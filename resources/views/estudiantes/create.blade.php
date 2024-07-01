@extends('layouts.app')

@section('content')
<h1>Crear nuevo estudiante</h1>
<form action="{{route('estudiantes.store')}}" method="POST">
    @csrf

    <div class="row">
        <div class="col-md-4">
            <label for="nombre" class="form-label">Nombres</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="apellido" class="form-label">Apellidos</label>
            <input type="text" name="apellido" id="apellido" class="form-control" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="pin" class="form-label">PIN</label>
            <input type="password" class="form-control" id="pin" name="pin" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{route('estudiantes.index')}}">Cancelar</a>
        </div>
    </div>
</form>

@endsection
