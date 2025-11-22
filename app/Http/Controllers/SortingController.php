<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sorting;
use Illuminate\Support\Facades\Storage;

class SortingController extends Controller
{
    /**
     * Display all sorting guides (Resident view)
     */
    public function index()
    {
        $guides = Sorting::all();
        return view('residents.sorting', compact('guides'));
    }

    /**
     * Show form to create a new sorting guide (Admin/Collector)
     */
    public function create()
    {
        return view('admin.sortings.create'); // blade form for admin
    }

    /**
     * Store a new sorting guide
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'examples' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // optional image
        ]);

        // Upload image if exists
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sorting_guides', 'public');
        }

        Sorting::create($validated);

        return redirect()->route('sortings.index')->with('success', 'Sorting guide added successfully!');
    }

    /**
     * Show a single sorting guide (optional)
     */
    public function show($id)
    {
        $guide = Sorting::findOrFail($id);
        return view('admin.sortings.show', compact('guide'));
    }

    /**
     * Show form to edit a sorting guide (Admin/Collector)
     */
    public function edit($id)
    {
        $guide = Sorting::findOrFail($id);
        return view('admin.sortings.edit', compact('guide'));
    }

    /**
     * Update an existing sorting guide
     */
    public function update(Request $request, $id)
    {
        $guide = Sorting::findOrFail($id);

        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'examples' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($guide->image && Storage::disk('public')->exists($guide->image)) {
                Storage::disk('public')->delete($guide->image);
            }
            $validated['image'] = $request->file('image')->store('sorting_guides', 'public');
        }

        $guide->update($validated);

        return redirect()->route('sortings.index')->with('success', 'Sorting guide updated successfully!');
    }

    /**
     * Delete a sorting guide
     */
    public function destroy($id)
    {
        $guide = Sorting::findOrFail($id);

        // Delete image if exists
        if ($guide->image && Storage::disk('public')->exists($guide->image)) {
            Storage::disk('public')->delete($guide->image);
        }

        $guide->delete();

        return redirect()->route('sortings.index')->with('success', 'Sorting guide deleted successfully!');
    }
}


