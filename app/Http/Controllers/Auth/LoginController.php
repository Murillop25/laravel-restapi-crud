<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class LoginController extends Controller
{

    // Mostrar formulario de login
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'login' => 'required|string', // Puede ser email o username
        'password' => 'required|string'
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // Determinar si el usuario ingresó un email o un username
    $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    // Construir credenciales con email o username
    $credentials = [
        $fieldType => $request->login,
        'password' => $request->password
    ];

    // Verificar si el usuario existe en la base de datos
    $user = User::where($fieldType, $request->login)->first();
    if (!$user) {
        return back()->withErrors(['login' => 'Usuario no registrado'])->withInput();
    }

    // Agregar log para verificar si el campo 'is_active' es correcto
    Log::info('Valor de is_active para el usuario: ' . $user->is_active);

    // Verificar si el usuario está activo antes de intentar autenticarlo
    if ($user->is_active == 0) { // Usar == para comparar correctamente el valor
        // Si está inactivo, no dejarlo iniciar sesión
        return back()->withErrors(['login' => 'Tu cuenta está inactiva. Contacta al administrador.'])->withInput();
    }

    // Intentar autenticar al usuario (solo si está activo)
    if (!Auth::attempt($credentials)) {
        return back()->withErrors(['password' => 'Contraseña errónea'])->withInput();
    }

    // Agregar registro de log
    Log::info('Inicio de sesión exitoso para el usuario: ' . $user->email);

    // Regenerar la sesión
    $request->session()->regenerate();

    return redirect()->route('home')->with('success', 'Inicio de sesión exitoso.');
}

    // Cerrar sesión
    public function logout(Request $request)
    {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}
