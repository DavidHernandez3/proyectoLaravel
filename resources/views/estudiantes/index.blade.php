@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success fade show" id="success-message" data-bs-dismiss="alert" role="alert">
            {{ session('success')}}
        </div>
    @endif

    <h1>Listado de Estudiantes</h1>
    <form action="{{ route('estudiantes.index') }}" method="GET">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary m-2">Buscar</button> &nbsp;
                <a href="{{ route('estudiantes.create') }}" class="btn btn-success">Nuevo estudiante</a>
            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo Electronico</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($estudiantes as $item)
                <tr>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->apellido }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        <a href="{{ route('estudiantes.show', $item->id) }}" class="btn btn-outline-secondary p-2 mx-2">Ver</a>
                        <a href="{{ route('estudiantes.edit', $item->id )}}" class="btn btn-outline-info p-2 mx-2">Editar</a>
                       <a href="{{ route('estudiantes.delete', $item->id )}}" class="btn btn-outline-danger p-2 mx-2">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12">
            {{ $estudiantes->links() }}
        </div>
    </div>
@endsection
