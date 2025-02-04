@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Actualizar Estudiante</h1>

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $student->phone }}" required>
        </div>
        <div class="form-group" mb-3>
            <label for="language">Idioma</label>
            <select class="form-control" id="language" name="language" required>
                <option value="English" {{ $student->language == 'English' ? 'selected' : '' }}>Inglés</option>
                <option value="Spanish" {{ $student->language == 'Spanish' ? 'selected' : '' }}>Español</option>
                <option value="French" {{ $student->language == 'French' ? 'selected' : '' }}>Francés</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
