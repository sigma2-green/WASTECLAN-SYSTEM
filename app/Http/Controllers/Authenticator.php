<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Authenticator extends Controller
{
    /**
     * Show the sign-up form
     */
    public function showSignupForm()
    {
        return view('sign-up');
    }

    /**
     * Handle new user registration
     */
    public function processSignup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create and save user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Automatically log in the new user
        Auth::login($user);

        // Redirect to dashboard
        return redirect()->route('dashboard')->with('success', 'Account created successfully!');
    }

    /**
     * Show login form
     */
    public function showLoginForm()
    {
        // If already logged in, go to dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Welcome back, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials, please try again.',
        ])->onlyInput('email');
    }

    /**
     * Log out the user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form')->with('success', 'Logged out successfully.');
    }
}



