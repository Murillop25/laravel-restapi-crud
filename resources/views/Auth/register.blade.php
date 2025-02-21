@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Registro</h1>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="lastname">Apellido</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="birthdate">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Contraseña</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" required>
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
</div>
@endsection
