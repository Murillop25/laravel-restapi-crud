@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Perfil</h2>
    <form action="{{ route('user.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-3">
            <label for="lastname" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
        </div>

        <div class="mb-3">
            <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate', $user->birthdate) }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nueva Contraseña</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
    </form>
</div>
@endsection
