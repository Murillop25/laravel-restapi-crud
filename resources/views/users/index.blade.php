@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Users</h1>
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
    
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createUserModal">Create User</button>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}">Edit</button>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Include the modals -->
@include('users.create')
@include('users.edit')

<!-- Include the script modalUser.js only on this page -->
@vite('resources/js/modalUser.js')
@endsection