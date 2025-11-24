@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>My Reported Issues</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($issues as $issue)
                <tr>
                    <td>{{ $issue->created_at->format('Y-m-d') }}</td>
                    <td>{{ $issue->type }}</td>
                    <td>{{ $issue->description }}</td>
                    <td>{{ $issue->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No issues reported.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h4>Report a New Issue</h4>
    <form method="POST" action="{{ route('resident.issues.store') }}">
        @csrf
        <div class="mb-3">
            <label for="type" class="form-label">Issue Type</label>
            <input type="text" name="type" id="type" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Issue</button>
    </form>
</div>
@endsection