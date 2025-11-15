<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resident;
use App\Models\User;

class ResidentController extends Controller
{
    /**
     * Display a listing of residents (admin only)
     */
    public function index()
    {
        $this->authorize('viewAny', Resident::class); // optional: use policies
        $residents = Resident::with('user')->latest()->paginate(15);

        return view('residents.index', compact('residents'));
    }

    /**
     * Display the specified resident (admin only)
     */
    public function show(Resident $resident)
    {
        return view('residents.show', compact('resident'));
    }

    /**
     * Show the form for editing the logged-in resident profile
     */
    public function edit(Resident $resident)
    {
        // Allow resident to edit their own profile or admin
        if (Auth::user()->id !== $resident->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        return view('residents.edit', compact('resident'));
    }

    /**
     * Update the resident profile
     */
    public function update(Request $request, Resident $resident)
    {
        // Allow resident to update their own profile or admin
        if (Auth::user()->id !== $resident->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $resident->update($request->only('address', 'phone'));

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Remove the specified resident (admin only)
     */
    public function destroy(Resident $resident)
    {
        $this->authorize('delete', $resident); // optional: use policy
        $resident->delete();

        return redirect()->route('residents.index')->with('success', 'Resident deleted successfully!');
    }

    /**
     * Display the logged-in user's profile
     */
    public function profile()
    {
        $user = Auth::user();
        $resident = $user->resident; // relationship from User model

        return view('profile', compact('user', 'resident'));
    }

    // Show settings page
public function settings()
{
    $user = auth()->user();
    return view('settings', compact('user'));
}

// Delete account
public function destroyAccount(Request $request)
{
    $user = auth()->user();

    // Optional: require password confirmation
    $request->validate([
        'password' => 'required',
    ]);

    if (!\Hash::check($request->password, $user->password)) {
        return back()->withErrors(['password' => 'Password does not match our records']);
    }

    Auth::logout();

    // Delete user (this will also delete related resident record if foreign key with cascade is set)
    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Your account has been deleted successfully.');
}

}

