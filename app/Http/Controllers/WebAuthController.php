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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role to user
        $user->assignRole($request->role);

        // Auto login after registration
        Auth::login($user);

        // Redirect based on role
        if ($user->hasRole('dept')) {
            return redirect('/dept/home');
        }

        if ($user->hasRole('exam-controller')) {
            return redirect('/exam/home');
        }

        return redirect('/home');
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

