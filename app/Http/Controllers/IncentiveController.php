<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incentive;

class IncentiveController extends Controller
{
    // Display all incentives
    public function index()
    {
        $incentives = Incentive::all();
        return response()->json($incentives);
    }

    // Show a single incentive
    public function show($id)
    {
        $incentive = Incentive::findOrFail($id);
        return response()->json($incentive);
    }

    // Create a new incentive
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $incentive = Incentive::create($request->all());
        return response()->json($incentive, 201);
    }

    // Update an incentive
    public function update(Request $request, $id)
    {
        $incentive = Incentive::findOrFail($id);
        $incentive->update($request->all());
        return response()->json($incentive);
    }

    // Delete an incentive
    public function destroy($id)
    {
        $incentive = Incentive::findOrFail($id);
        $incentive->delete();
        return response()->json(null, 204);
    }
}

