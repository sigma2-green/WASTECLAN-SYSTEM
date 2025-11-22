<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Collector;
use App\Models\Route;
use App\Models\Bin;
use App\Models\BinAlerts;
use App\Models\SafetyReport;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CollectorController extends Controller
{
    /**
     * Display a listing of collectors (Admin view)
     */
    public function index()
    {
        $this->authorizeAdmin();
        $collectors = Collector::with('user', 'routes')->get();
        return view('admin.collectors.index', compact('collectors'));
    }

    /**
     * Show form to create a new collector (Admin view)
     */
    public function create()
    {
        $this->authorizeAdmin();
        $routes = Route::all();
        return view('admin.collectors.create', compact('routes'));
    }

    /**
     * Store a newly created collector (Admin assigns)
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'vehicle_number' => 'required|string|max:50',
            'routes' => 'required|array',
        ]);

        // Create user with temporary password
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('password123'), // temp password
            'role' => 'collector',
            'phone' => $validated['phone'] ?? null,
        ]);

        // Create collector profile
        $collector = Collector::create([
            'user_id' => $user->id,
            'vehicle_number' => $validated['vehicle_number'],
            'status' => 'active',
        ]);

        // Assign routes
        $collector->routes()->sync($validated['routes']);

        return redirect()->route('admin.collectors.index')->with('success', 'Collector created successfully! They can login with default password.');
    }

    /**
     * Collector Dashboard
     */
    public function dashboard()
    {
        $this->authorizeCollector();

        $user = Auth::user();
        $collector = $user->collector()->with('routes.bins')->first();
        $bins = $collector->bins;
        $alerts = BinAlerts::whereIn('bin_id', $bins->pluck('id'))->get();
        $safetyReports = $collector->safetyReports()->latest()->get();

        return view('collectors.dashboard', compact('collector', 'bins', 'alerts', 'safetyReports'));
    }

    /**
     * Submit Safety Report
     */
    public function submitSafetyReport(Request $request)
    {
        $this->authorizeCollector();

        $validated = $request->validate([
            'report_type' => 'required|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $collector = Auth::user()->collector;

        $path = $request->hasFile('photo')
            ? $request->file('photo')->store('safety_reports', 'public')
            : null;

        SafetyReport::create([
            'collector_id' => $collector->user_id,
            'report_type' => $validated['report_type'],
            'description' => $validated['description'],
            'photo' => $path,
        ]);

        return redirect()->back()->with('success', 'Safety report submitted successfully!');
    }

    /**
     * Show single collector (Admin view)
     */
    public function show($id)
    {
        $this->authorizeAdmin();
        $collector = Collector::with('user', 'routes')->findOrFail($id);
        return view('admin.collectors.show', compact('collector'));
    }

    /**
     * Edit collector profile (Admin view)
     */
    public function edit($id)
    {
        $this->authorizeAdmin();
        $collector = Collector::with('user', 'routes')->findOrFail($id);
        $routes = Route::all();
        return view('admin.collectors.edit', compact('collector', 'routes'));
    }

    /**
     * Update collector details (Admin)
     */
    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        $collector = Collector::with('user')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $collector->user->id,
            'phone' => 'nullable|string|max:20',
            'vehicle_number' => 'required|string|max:50',
            'routes' => 'required|array',
        ]);

        $collector->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);

        $collector->update([
            'vehicle_number' => $validated['vehicle_number'],
        ]);

        $collector->routes()->sync($validated['routes']);

        return redirect()->route('admin.collectors.index')->with('success', 'Collector updated successfully!');
    }

    /**
     * Delete a collector (Admin)
     */
    public function destroy($id)
    {
        $this->authorizeAdmin();

        $collector = Collector::findOrFail($id);
        $collector->user()->delete();
        $collector->delete();

        return redirect()->route('admin.collectors.index')->with('success', 'Collector deleted successfully!');
    }

    /* ==========================
       |  HELPER FUNCTIONS
       ========================== */

    /**
     * Ensure current user is admin
     */
    private function authorizeAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Ensure current user is collector
     */
    private function authorizeCollector()
    {
        if (!Auth::check() || Auth::user()->role !== 'collector') {
            abort(403, 'Unauthorized');
        }
    }
}
