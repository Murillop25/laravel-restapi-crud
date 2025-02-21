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
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $credentials = $request->only('email', 'password');
    
        // Verificar si el correo existe en la base de datos
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Correo no registrado'])->withInput();
        }
    
        // Intentar autenticar al usuario
        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['password' => 'Contraseña errónea'])->withInput();
        }
    
        // Agregar registro de log
        Log::info('Inicio de sesión exitoso para el usuario: ' . $user->email);
        // Mostrar alerta antes de redirigir
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
