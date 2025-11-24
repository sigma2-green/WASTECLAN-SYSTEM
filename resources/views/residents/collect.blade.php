@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>My Waste Collections</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Bin</th>
                <th>Status</th>
                <th>Collector</th>
            </tr>
        </thead>
        <tbody>
            @forelse($collections as $collection)
                <tr>
                    <td>{{ $collection->date }}</td>
                    <td>{{ $collection->bin->name ?? 'N/A' }}</td>
                    <td>{{ $collection->status }}</td>
                    <td>{{ $collection->collector->name ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No collections found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h4>Request New Collection</h4>
    <form method="POST" action="{{ route('resident.collections.request') }}">
        @csrf
        <div class="mb-3">
            <label for="bin_id" class="form-label">Select Bin</label>
            <select name="bin_id" id="bin_id" class="form-control">
                @foreach($bins as $bin)
                    <option value="{{ $bin->id }}">{{ $bin->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Request Collection</button>
    </form>
</div>
@endsection
