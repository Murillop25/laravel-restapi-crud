<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
        // Mostrar formulario de login
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        // Generar la URL en el controlador y pasarla a la vista
        $loginUrl = route('login.process');

        return view('auth.login', compact('loginUrl')); // Pasar la URL a la vista
    }

    public function login(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Buscar al usuario
        $user = User::where('email', $request->email)->first();

        // Si no existe el usuario, devolver error
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'El correo ingresado no está registrado',
                'redirect' => false,
            ]);
        }

        // Verificar la contraseña
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'La contraseña es incorrecta',
                'redirect' => false,
            ]);
        }

        // Intentar iniciar sesión
        if (Auth::loginUsingId($user->id)) {
            return response()->json([
                'success' => true,
                'message' => 'Inicio de sesión exitoso',
                'redirect' => true,
                'url' => route('home'), // Redirigir a la página de inicio
            ]);
        }

        // Si todo falla
        return response()->json([
            'success' => false,
            'message' => 'Ocurrió un error inesperado',
            'redirect' => false,
        ]);
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
