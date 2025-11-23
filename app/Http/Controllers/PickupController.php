<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use App\Models\Resident;
use App\Models\Collector;
use App\Models\Bin;
use App\Models\Route;
use Illuminate\Http\Request;

class PickupController extends Controller
{

    public function index()
    {
        $pickups = Pickup::with(['resident', 'collector', 'bin', 'route'])->latest()->get();
        return view('admin.manage_collection', compact('pickups'));
    }


    public function create()
    {
        return view('admin.pickups.create', [
            'residents' => Resident::all(),
            'collectors' => Collector::all(),
            'bins' => Bin::all(),
            'routes' => Route::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'bin_id' => 'required|exists:bins,id',
            'route_id' => 'required|exists:routes,id',
            'pickup_date' => 'required|date',
        ]);

        Pickup::create([
            'resident_id' => $request->resident_id,
            'collector_id' => $request->collector_id ?? null, // Admin assigns later
            'bin_id' => $request->bin_id,
            'route_id' => $request->route_id,
            'pickup_date' => $request->pickup_date,
            'status' => 'pending',
        ]);

        return redirect()->route('pickups.index')->with('success', 'Pickup created successfully.');
    }

    public function edit(Pickup $pickup)
    {
        return view('admin.pickups.edit', [
            'pickup' => $pickup,
            'residents' => Resident::all(),
            'collectors' => Collector::all(),
            'bins' => Bin::all(),
            'routes' => Route::all()
        ]);
    }

    public function update(Request $request, Pickup $pickup)
    {
        $request->validate([
            'collector_id' => 'nullable|exists:collectors,id',
            'status' => 'required|string'
        ]);

        $pickup->update([
            'collector_id' => $request->collector_id,
            'status' => $request->status
        ]);

        return redirect()->route('pickups.index')->with('success', 'Pickup updated successfully.');
    }
}

