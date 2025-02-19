<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AuthController extends Controller
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

    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();
        return redirect()->route('home')->with('success', 'Inicio de sesión exitoso.');
    }

    return back()->withErrors(['email' => 'Las credenciales no coinciden con nuestros registros.'])->withInput();
}

    // Mostrar formulario de registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Procesar registro de usuario
    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'birthdate' => 'required|date',
        'password' => 'required|min:8|confirmed'
    ],[
        'password.required'=> 'La contraseña es obligatoria',
        'pasaword.min'=> 'La contraseña debe tener al menos 8 caracteres',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    User::create([
        'name' => $request->name,
        'lastname' => $request->lastname,
        'email' => $request->email,
        'birthdate' => $request->birthdate,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('login')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
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
