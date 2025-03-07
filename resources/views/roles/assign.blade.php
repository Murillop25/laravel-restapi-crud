@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Asignar Roles a Usuarios</h2>
    
    <form action="{{ route('assign.role') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user" class="form-label">Seleccionar Usuario:</label>
            <select name="user_id" id="user" class="form-control" required>
                <option value="">-- Seleccione un usuario --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }} ({{ $user->email }}) - {{ $user->roles->pluck('name')->join(', ') }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <div class="mb-3">
            <label for="role" class="form-label">Seleccionar Rol:</label>
            <select name="role" id="role" class="form-control" required>
                <option value="admin">Admin</option>
                <option value="director">Director</option>
                <option value="maestro">Maestro</option>
                <option value="supervisor">Supervisor</option>
                <option value="estudiante">Estudiante</option>
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary" id="assignRoleBtn" disabled>Asignar Rol</button>
    </form>    
</div>
@push('scripts')
<script>
    window.onload = function() {
        const successMessage = @json(session('success'));
        const errorMessages = @json($errors->all());
        showAlerts(successMessage, errorMessages);
    };
</script>
@endpush    
@endsection
