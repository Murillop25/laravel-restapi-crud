<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RoleController extends Controller
{
    public function showAssignRoleForm()
    {
        $users = User::all();
        return view('roles.assign', compact('users'));
    }

    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:admin,director,maestro,supervisor,estudiante',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->role = $request->role;
        $user->update();

        return redirect()->back()->with('success', 'Rol asignado correctamente.');
    }

}
