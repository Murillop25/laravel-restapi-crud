<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SGD</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
<body>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @auth
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <!-- Marca o título del sitio -->
                <a class="navbar-brand" href="{{ url('/') }}">Sistema gestor</a>
                
                <!-- Botón para colapsar en móviles -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <!-- Enlaces -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                         <!-- Enlace a la página de inicio (siempre visible) -->
                         <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ url('/') }}">Inicio</a>
                        </li>
                        <!-- Enlace a la página de roles (solo visible para administradores) -->
                        @if(auth()->user() && auth()->user()->hasRole('admin'))
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() == 'assign.role' ? 'active' : '' }}" href="{{ route('assign.role') }}">Asignar Roles</a>
                            </li>
                        @endif                
                        <!-- Enlace para gestión de estudiantes (visible para admin, director y maestro) -->
                        @if(auth()->user() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('director') || auth()->user()->hasRole('maestro')))
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() == 'students.show' ? 'active' : '' }}" href="{{ route('students.show') }}">Gestión de Estudiantes</a>
                            </li>
                        @endif
                        <!-- Enlace para ver la lista total de estudiantes (visible para admin, director y supervisor) -->
                        @if(auth()->user() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('director') || auth()->user()->hasRole('supervisor')))
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() == 'students.list' ? 'active' : '' }}" href="{{ route('students.list') }}">Lista de Estudiantes</a>
                            </li>
                        @endif
                        <!-- Dropdown para "Mi perfil" y cerrar sesión (siempre visible) -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Editar perfil</a></li>
                
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Cerrar sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>                
                
            </div>
        </nav>    
    </header>
    @endauth

    <main>
        <div class="container-fluid container-content">
            @yield('content') <!-- Aquí se incluirá el contenido específico de cada vista -->
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>