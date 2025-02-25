<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit()
    {
        // Obtener al usuario autenticado
        $user = auth()->user();

        // Pasar el usuario a la vista
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // Obtener al usuario autenticado
        $user = \App\Models\User::find(auth()->id());

        // Validación de los campos
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,  // Agregar validación para el username
            'birthdate' => 'required|date',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Actualizar los campos del usuario
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->username = $request->username;  // Actualizar el campo de username
        $user->email = $request->email;
        $user->birthdate = $request->birthdate;

        // Actualizar la contraseña si se llenó el campo
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }
}
