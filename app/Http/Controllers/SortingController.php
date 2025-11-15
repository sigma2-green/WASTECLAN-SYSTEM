<?php

namespace App\Http\Controllers;

use App\Models\Sorting;
use Illuminate\Http\Request;

class SortingController extends Controller
{
    public function index()
    {
        $sortings = Sorting::all();
    $sorting = null; // avoid undefined variable
    return view('residents.sorting', compact('sortings', 'sorting'));
    }

    public function create()
    {
        return view('sortings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:255',
        ]);

        Sorting::create($request->all());
        return redirect()->route('sortings.index')->with('success', 'Sorting guide created successfully.');
    }

    public function show(Sorting $sorting)
    {
        return view('sortings.show', compact('sorting'));
    }

    public function edit(Sorting $sorting)
    {
        $sortings = Sorting::all();
        return view('residents.sorting', compact('sortings', 'sorting'));
    }

    public function update(Request $request, Sorting $sorting)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:255',
        ]);

        $sorting->update($request->all());
        return redirect()->route('sortings.index')->with('success', 'Sorting guide updated successfully.');
    }

    public function destroy(Sorting $sorting)
    {
        $sorting->delete();
        return redirect()->route('sortings.index')->with('success', 'Sorting guide deleted successfully.');
    }
}

