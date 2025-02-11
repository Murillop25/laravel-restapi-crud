{{-- <!-- resources/views/students/newStudent.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Crear Estudiante</h1>

   <!-- Mostrar errores de validación -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif


    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group mb-3">
            <label for="language">Idioma</label>
            <select class="form-control" id="language" name="language" required>
                <option value="English">Inglés</option>
                <option value="Spanish">Español</option>
                <option value="French">Francés</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection --}}