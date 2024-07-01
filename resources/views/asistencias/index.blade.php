@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success fade show" id="success-message" data-bs-dismiss="alert" role="alert">
            {{ session('success')}}
        </div>
    @endif

    <h1>Listado de Asistencias</h1>
    <form action="{{ route('asistencias.index') }}" method="GET">
        @csrf
        <div class="row">
            <div class="col-sm-4">
                <label for="asistencia_id" class="form-label">Fecha de Asistencia</label>
                <select name="asistencia_id" class="form-control">
                    <option value="">Seleccione una fecha</option>
                    @foreach ($asistencias as $a)
                        <option value="{{ $a->id }}">{{ $a->fecha }} | {{ $a->estudiante->nombre }} {{ $a->estudiante->apellido }} | {{ $a->grupo->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary m-2">Buscar</button> &nbsp;
                <a href="{{ route('asistencias.create') }}" class="btn btn-success">Nueva asistencia</a>
            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Estudiante</th>
                <th>Grupo</th>
                <th>Fecha</th>
                <th>Hora de Entrada</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($asistencias as $item)
                <tr>
                    <td>{{ $item->estudiante->nombre }} {{ $item->estudiante->apellido }}</td>
                    <td>{{ $item->grupo->nombre }}</td>
                    <td>{{ $item->fecha }}</td>
                    <td>{{ $item->hora_entrada }}</td>
                    <td>
                        <a href="{{ route('asistencias.show', $item->id) }}" class="btn btn-outline-secondary p-2 mx-2">Ver</a>
                       <a href="{{ route('asistencias.delete', $item->id )}}" class="btn btn-outline-danger p-2 mx-2">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12">
            {{ $asistencias->links() }}
        </div>
    </div>
@endsection
