<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * REGISTER USER
     */
    public function register(Request $request)
    {
        // Validation
        $fields = $request->validate([
            'username' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'min:3', 'confirmed'],
        ]);

        // Create user (IMPORTANT: hash password + default role)
        $user = User::create([
            'username' => $fields['username'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
            'role' => 'user',
        ]);

        // Login user
        Auth::login($user);

        // Redirect
        return redirect()->route('dashboard');
    }

    /**
     * LOGIN USER
     */
    public function login(Request $request)
    {
        // Validate
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login
        if (Auth::attempt($fields, $request->remember)) {

            $request->session()->regenerate();

            // ROLE BASED REDIRECT (IMPORTANT FIX)
            if (auth()->user()->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'failed' => 'Wrong email or password'
        ]);
    }

    /**
     * LOGOUT USER
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}