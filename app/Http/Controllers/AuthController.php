<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{


    // Register (web users)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login');
    }

    // Login (WEB)
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // ROLE REDIRECT
            if ($user->hasRole('super-admin')) {
                return redirect('/admin/dashboard');
            }

            if ($user->hasRole('dept')) {
                return redirect('/dept/home');
            }

            if ($user->hasRole('exam-controller')) {
                return redirect('/exam/home');
            }

            return redirect('/home');
        }

        return back()->with('error', 'Invalid credentials');
    }

    // Get logged in user (web)
    public function user(Request $request)
    {
        return Auth::user();
    }

    // Logout (WEB)
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
