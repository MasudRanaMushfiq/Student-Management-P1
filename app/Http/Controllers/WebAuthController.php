<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebAuthController extends Controller
{   

    /*
    |--------------------------------------------------------------------------
    | LOGIN METHODS
    |--------------------------------------------------------------------------
    */
    
    // SHOW LOGIN PAGE
    public function showLogin()
    {
        return view('auth.login');
    }

    // HANDLE LOGIN
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Role-based redirect after login
            if ($user->hasRole('super-admin')) {
                return redirect()->intended('/admin/dashboard');
            }

            if ($user->hasRole('dept')) {
                return redirect()->intended('/dept/home');
            }

            if ($user->hasRole('exam-controller')) {
                return redirect()->intended('/exam/home');
            }

            // Default redirect
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER METHODS
    |--------------------------------------------------------------------------
    */
    
    // SHOW REGISTER PAGE
    public function showRegister()
    {
        return view('auth.register');
    }

    // HANDLE REGISTRATION
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('home')
            ->with('success', 'Account created successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT METHOD
    |--------------------------------------------------------------------------
    */
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

