@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Editar Perfil</h1>

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="lastname">Apellido</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ auth()->user()->lastname }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="birthdate">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ auth()->user()->birthdate }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Contraseña</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <small class="form-text text-muted">Deja este campo vacío si no deseas cambiar la contraseña.</small>
        </div>

        <div class="form-group mb-3">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
    </form>
</div>
@endsection