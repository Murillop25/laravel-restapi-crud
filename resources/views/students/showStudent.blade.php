@extends('layouts.app')

@section('content')
   <div class="container mt-5">
    <h1>Lista de Estudiantes</h1>

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
    
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createStudentModal">Crear Estudiante</button>

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
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateStudentModal" data-id="{{ $student->id }}" data-name="{{ $student->name }}" data-email="{{ $student->email }}" data-phone="{{ $student->phone }}" data-language="{{ $student->language }}">Actualizar</button>
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
   </div>

   <!-- Modal para crear estudiante -->
   <div class="modal fade" id="createStudentModal" tabindex="-1" aria-labelledby="createStudentModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="createStudentModalLabel">Crear Estudiante</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form id="createStudentForm" action="{{ route('students.store') }}" method="POST">
                       @csrf
                       <div class="form-group">
                           <label for="name">Nombre</label>
                           <input type="text" class="form-control" id="name" name="name" required>
                       </div>
                       <div class="form-group">
                           <label for="email">Correo Electrónico</label>
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
           </div>
       </div>
   </div>

  <!-- Modal para actualizar estudiante -->
  <div class="modal fade" id="updateStudentModal" tabindex="-1" aria-labelledby="updateStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStudentModalLabel">Actualizar Estudiante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateStudentForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="update-id" name="id">
                    <div class="form-group">
                        <label for="update-name">Nombre</label>
                        <input type="text" class="form-control" id="update-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="update-email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="update-email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="update-phone">Teléfono</label>
                        <input type="text" class="form-control" id="update-phone" name="phone" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="update-language">Idioma</label>
                        <select class="form-control" id="update-language" name="language" required>
                            <option value="English">Inglés</option>
                            <option value="Spanish">Español</option>
                            <option value="French">Francés</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection