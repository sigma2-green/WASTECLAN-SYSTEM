<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Collection;
use App\Models\Bin;

class ResidentCollectionController extends Controller
{
    public function requestCollection(Request $request)
    {
        $request->validate([
            'bin_id' => 'required|exists:bins,id',
        ]);

        // Create a new collection request for the logged-in resident
        $collection = new Collection();
        $collection->resident_id = Auth::user()->resident->id;
        $collection->bin_id = $request->bin_id;
        $collection->status = 'Requested';
        $collection->save();

        return redirect()->back()->with('success', 'Collection requested successfully!');
    }
}
