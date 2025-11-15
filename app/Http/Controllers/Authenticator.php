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
        'role' => 'required|in:resident,collector', // remove admin signup from here
        'phone' => 'nullable|string|max:20',
        'profile_photo' => 'nullable|image|max:2048',
    ]);

    // Store profile photo if uploaded
    $photoPath = $request->hasFile('profile_photo')
        ? $request->file('profile_photo')->store('profile_photos', 'public')
        : null;

    // Create user
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'],
        'phone' => $validated['phone'] ?? null,
        'profile_photo' => $photoPath,
    ]);

    // If role is resident, create resident profile automatically
    if ($user->role === 'resident') {
        $user->resident()->create([
            'address' => $request->input('address') ?? '',
            // Add other fields if needed
        ]);
    }

    return redirect()->route('login.form')->with('success', 'Account created successfully! Please log in.');
}


    /**
     * Show login form
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'collector') {
                return redirect()->route('collector.dashboard');
            }
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    /**
     * Show user profile
     */
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    /**
     * Edit profile
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('residents.edit', compact('user'));
    }

    /**
     * Update profile details
     */
    public function updateProfile(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'profile_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    if ($request->hasFile('profile_photo')) {
        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $user->profile_photo = $path;
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->save();

    return redirect()->route('profile')->with('success', 'Profile updated successfully!');
}
    /**
     * Change password
     */
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password changed successfully!');
    }



}






