@extends('layouts.app')

@section('content')
<h1>Crear nuevo grupo</h1>
<form action="{{route('grupos.store')}}" method="POST">
    @csrf

    <div class="row">
        <div class="col-md-4">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="5" class="form-control"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{route('grupos.index')}}">Cancelar</a>
        </div>
    </div>
</form>

@endsection
