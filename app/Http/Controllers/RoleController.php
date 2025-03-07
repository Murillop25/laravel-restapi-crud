<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class RoleController extends Controller
{
    public function showAssignRoleForm()
    {
        $users= User::orderBy('name')->get();
        // $users = User::all();
        return view('roles.assign', compact('users'));
    }

    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:admin,director,maestro,supervisor,estudiante',
        ]);
    
        $user = User::findOrFail($request->user_id);
    
        // Asignar el rol en la tabla users
        $user->role = $request->role;
        $user->update();
    
        // Obtener el ID del rol a partir del nombre del rol
        $role = Role::where('name', $request->role)->first();
    
        // Insertar la relación en la tabla role_user
        $user->roles()->attach($role->id);
    
        return redirect()->back()->with('success', 'Rol asignado correctamente.');
    }    

}
