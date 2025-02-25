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
                        <!-- Enlace a la página de inicio -->
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">Inicio</a>
                        </li>
                        
                        <!-- Enlace para ver estudiantes -->
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'students.show' ? 'active' : '' }}" href="{{ route('students.show') }}">Ver Estudiantes</a>
                        </li>
        
                        <!-- Dropdown para "Mi perfil" y cerrar sesión -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <!-- Enlace para editar el perfil -->
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Editar perfil</a></li>
        
                                <!-- Formulario para cerrar sesión -->
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