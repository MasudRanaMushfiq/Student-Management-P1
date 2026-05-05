<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users', compact('users'));
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required'
        ]);

        // THIS IS THE IMPORTANT LINE
        $user->syncRoles([$request->role]);

        return back()->with('success', 'Role updated successfully');
    }
}

