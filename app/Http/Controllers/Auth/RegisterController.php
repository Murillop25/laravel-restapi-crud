<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
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
        'email.unique'=> 'El correo electrónico ya está registrado',
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
}
