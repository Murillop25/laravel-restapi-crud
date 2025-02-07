<!-- filepath: /c:/Users/Administrador/Documents/GitHub/laravel-restapi-crud/resources/views/students/showStudent.blade.php -->
@extends('layouts.app')

@section('content')
   <div class="container mt-5">
    <h1>Lista de Estudiantes</h1>

    <!-- Mensajes de éxito y error -->
    @if (session('success'))
        <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            setTimeout(function () {
                let alert = document.getElementById('success-message');
                if (alert) {
                    alert.style.transition = "opacity 0.5s ease-out";
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 500); // Elimina el mensaje después de desaparecer
                }
            }, 3000); // Desvanece el mensaje después de 3 segundos
        </script>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($students->isEmpty())
        <p>No hay estudiantes registrados.</p>
    @else
        <!-- Lista de estudiantes -->
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
                            <div class="d-flex gap-2">
                                <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal" data-url="{{ route('students.edit', $student->id) }}">
                                    Editar
                                </a>                                                                                 
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este estudiante?');" class="w-100">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-60">Eliminar</button>
                                </form>
                            </div>
                        </td>                    
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalStudent" data-url="{{ route('students.create') }}">
        Crear Nuevo Estudiante
    </button> 

    <!-- Modal para crear estudiante -->
    @include('students.modalCreateStudent')

    <!-- Modal para editar estudiante -->
    @include('students.modalUpdateStudent')
   </div>
@endsection