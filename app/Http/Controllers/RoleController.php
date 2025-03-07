<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class RoleController extends Controller
{
     // Mostrar la vista principal de administración
     public function portal()
     {
         // Obtener todos los usuarios y roles
         $users = User::all();
         $roles = Role::all();
         return view('admin.portal', compact('users', 'roles'));
     }

    // Asignar un rol y eliminar los roles actuales de un usuario
    public function assignRole(Request $request)
    {
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'role' => 'required|exists:roles,name',
    ]);

    $user = User::find($request->user_id);

    // Buscar el ID del rol basado en su nombre
    $role = Role::where('name', $request->role)->first();

    if (!$role) {
        return back()->withErrors(['role' => 'Rol no encontrado'])->withInput();
    }

    // Asignar el rol usando el ID en la tabla intermedia
    $user->roles()->sync([$role->id]);

    // También actualizar el campo 'role' en la tabla 'users' (si lo deseas)
    $user->role = $role->name; // Actualizamos el campo 'role' en la tabla users
    $user->save();

    // Registrar en los logs
    Log::info('Rol asignado a usuario: ' . $user->name . ' | Rol: ' . $request->role);

       return redirect()->route('admin.portal')->with('success', 'Rol asignado correctamente.');
    }

 
     // Activar o desactivar un usuario
     public function toggleUserStatus(Request $request)
     {
         $user = User::find($request->user_id);
         
         if (!$user) {
             return response()->json(['error' => 'Usuario no encontrado'], 404);
         }
     
         $user->is_active = !$user->is_active; // Alternar estado
         $user->save();
     
         Log::info('Cambio de estado para el usuario: ' . $user->name . ' | Estado: ' . ($user->is_active ? 'Activo' : 'Inactivo'));
     
         return response()->json([
             'success' => true,
             'message' => 'Estado de usuario actualizado correctamente.',
             'is_active' => $user->is_active
         ]);
     }
     
}