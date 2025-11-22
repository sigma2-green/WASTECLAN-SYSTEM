<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SafetyReport;
use Illuminate\Support\Facades\Auth;

class SafetyReportController extends Controller
{
    /**
     * Display a listing of safety reports (Collector view)
     */
    public function index()
    {
        $collector = Auth::user()->collector;
        $reports = $collector->safetyReports()->latest()->get();

        return view('collectors.safety_reports', compact('reports'));
    }

    /**
     * Show the form for creating a new safety report
     */
    public function create()
    {
        return view('collectors.create_safety_report'); // create a blade for the form
    }

    /**
     * Store a newly created safety report
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'report_type' => 'required|string', // 'hazard', 'incident', 'sorting_guide'
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

        $message = $validated['report_type'] === 'sorting_guide'
            ? 'Sorting guide submitted successfully!'
            : 'Safety report submitted successfully!';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Display a single report
     */
    public function show($id)
    {
        $report = SafetyReport::findOrFail($id);
        return view('collectors.show_safety_report', compact('report'));
    }

    /**
     * Show form to edit a report
     */
    public function edit($id)
    {
        $report = SafetyReport::findOrFail($id);
        return view('collectors.edit_safety_report', compact('report'));
    }

    /**
     * Update a report
     */
    public function update(Request $request, $id)
    {
        $report = SafetyReport::findOrFail($id);

        $validated = $request->validate([
            'report_type' => 'required|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('safety_reports', 'public');
            $report->photo = $path;
        }

        $report->report_type = $validated['report_type'];
        $report->description = $validated['description'];
        $report->save();

        return redirect()->back()->with('success', 'Report updated successfully!');
    }

    /**
     * Delete a report
     */
    public function destroy($id)
    {
        $report = SafetyReport::findOrFail($id);
        $report->delete();

        return redirect()->back()->with('success', 'Report deleted successfully!');
    }
}

