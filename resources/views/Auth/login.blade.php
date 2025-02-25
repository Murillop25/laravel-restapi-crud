@extends('layouts.app')

@section('content')
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <div class="container" id="container">
        <!-- Formulario de Registro -->
        <div class="form-container sign-up">
            <form id="loginForm" method="POST" action="{{ route('register') }}">
                @csrf
                <h2>Crear Cuenta</h2>                
                <input type="text" name="name" placeholder="Nombre" value="{{ old('name') }}" required />
                <input type="text" name="username" placeholder="Nombre de usuario" value="{{ old('username') }}" required />
                <input type="text" name="lastname" placeholder="Apellido" value="{{ old('lastname') }}" required />
                <input type="email" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}" required />
                <input type="date" name="birthdate" placeholder="Fecha de nacimiento" class="form-control" value="{{ old('birthdate') }}" required>
                <div class="input-group mb-0">
                    <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                    <button class="btn toggle-password" type="button">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="input-group mb-0">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" required>
                    <button class="btn toggle-password" type="button">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <button type="submit" class="form-button">Registrarse</button>
            </form>
        </div>

        <!-- Formulario de Inicio de Sesión -->
        <div class="form-container sign-in">
            <form method="POST" action="{{ route('login.process') }}">
                @csrf
                <h2>Iniciar Sesión</h2>
                <span>Utiliza tu correo o usuario y contraseña</span>
                <!-- Campo de texto para correo o nombre de usuario -->
                <input type="text" name="login" placeholder="Correo o Usuario" value="{{ old('login') }}" required />
        
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                    <button class="btn toggle-password" type="button">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                
                <button type="submit" class="form-button">Iniciar Sesión</button>
            </form>
        </div>
        

        <!-- Panel de Alternancia -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>¡Bienvenido!</h1>
                    <img src="{{ asset ('img/icon_TeleP.png') }}" alt="Telematica" class="img-fluid rounded">
                    <button class="hidden btn btn-outline-light" id="login">Iniciar Sesión</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>¡Bienvenido!</h1>
                    <img src="{{ asset ('img/icon_SGDp.png') }}" alt="Paisaje" class="img-fluid rounded">
                    <p>Regístrate con tus datos personales para usar todas las funciones</p>
                    <button class="hidden btn btn-outline-light" id="register">Registrarse</button>
                </div>
            </div>
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
    <script src="{{ asset('js/script2.js') }}"></script>
@endsection
