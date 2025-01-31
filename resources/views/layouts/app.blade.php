<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Estudiantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-5">
        <div class="container-fluid">
            <!-- Marca o título del sitio -->
            <a class="navbar-brand" href="{{ url('/') }}">Crud con api integrada</a>
            
            <!-- Botón para colapsar en móviles -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <!-- Enlaces -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- `ms-auto` para alinear los elementos a la derecha -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="{{ route('students.create') }}">Crear Estudiante</a> --}}
                        <a class="nav-link" >Crear Estudiante</a>
                    </li>
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="{{ route('students.index') }}">Ver Estudiantes</a> --}}
                        <a class="nav-link" >Crear Estudiante</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" >Crear Estudiante</a>
                        {{-- <a class="nav-link" href="{{ route('students.edit', ['id' => 1]) }}">Actualizar Estudiante</a> <!-- ID como ejemplo --> --}}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" >Crear Estudiante</a>
                        {{-- <a class="nav-link" href="{{ route('students.destroy', ['id' => 1]) }}">Eliminar Estudiante</a> <!-- ID como ejemplo --> --}}
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">
        @yield('content') <!-- Aquí se incluirá el contenido específico de cada vista -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>