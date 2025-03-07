@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-3">
        {{-- <h1>Portal de Administración</h1> --}}

        <!-- Asignar roles -->
        <h3>Asignar Rol</h3>
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

        <div class="mt-3">
            <!-- Activar / Desactivar usuario -->
            <h3>Gestión de Usuarios</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->is_active ? 'Activo' : 'Inactivo' }}</td>
                            <td>
                                <form action="{{ route('admin.toggle.user.status') }}" method="POST" class="toggle-status-form">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn toggle-status-btn" 
                                        data-user-id="{{ $user->id }}" 
                                        data-status="{{ $user->is_active ? '1' : '0' }}"
                                        style="background-color: {{ $user->is_active ? 'green' : 'gray' }}; color: white;">
                                        {{ $user->is_active ? 'Desactivar' : 'Activar' }}
                                    </button>
                                </form>
                            </td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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