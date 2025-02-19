<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
// Controller methods for user profile
public function edit()
{
   // Obtener el usuario autenticado
   $user = Auth::user();
   return view('user.edit', compact('user'));
}

public function update(Request $request)
{
    $user = Auth::user();

    // Validación de los datos
    $request->validate([
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'birthdate' => 'required|date',
        'password' => 'nullable|min:8|confirmed',  // Opcional
    ]);

    // Actualización de los datos del usuario
    $user->name = $request->name;
    $user->lastname = $request->lastname;
    $user->email = $request->email;
    $user->birthdate = $request->birthdate;

    // Si se ha proporcionado una nueva contraseña, actualizarla
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Guardar los cambios
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('user.edit')->withErrors(['error' => 'Usuario no autenticado.']);
    }
    

    // Redirigir con mensaje de éxito
    return redirect()->route('user.edit')->with('success', 'Perfil actualizado correctamente.');
}
}
