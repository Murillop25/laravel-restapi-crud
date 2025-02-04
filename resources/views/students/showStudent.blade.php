@extends('layouts.app')

@section('content')
   <div class="container mt-5">
    <h1>Lista de Estudiantes</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Idioma</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->language }}</td>
                    <td>
                        {{-- <a href="{{ route('students.uptStudent', $student->id) }}" class="btn btn-warning">Editar</a> --}}
                        <a href="" class="btn btn-warning mb-2 fill">Editar</a>
                        {{-- <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;"> --}}
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este estudiante?') ;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>                            
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="" class="btn btn-primary">Crear Nuevo Estudiante</a>
   </div>
@endsection
