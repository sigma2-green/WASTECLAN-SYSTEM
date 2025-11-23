@extends('layouts.collector')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Safety Reports</h2>

    <table class="table table-bordered shadow-sm">
        <thead>
            <tr>
                <th>Reported By</th>
                <th>Location</th>
                <th>Safety Issue</th>
                <th>Severity</th>
                <th>Date Reported</th>
            </tr>
        </thead>

        <tbody>
            @foreach($safetyReports as $safety)
                <tr>
                    <td>{{ $safety->user->name }}</td>
                    <td>{{ $safety->location }}</td>
                    <td>{{ $safety->description }}</td>
                    <td>
                        <span class="badge bg-{{ $safety->severity == 'high' ? 'danger' : 'warning' }}">
                            {{ ucfirst($safety->severity) }}
                        </span>
                    </td>
                    <td>{{ $safety->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>
@endsection
