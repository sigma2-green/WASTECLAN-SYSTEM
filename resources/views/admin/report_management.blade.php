@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Report Management</h2>

    <table class="table table-hover table-bordered shadow-sm">
        <thead>
            <tr>
                <th>User</th>
                <th>Location</th>
                <th>Description</th>
                <th>Status</th>
                <th>Date Reported</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->user->name }}</td>
                    <td>{{ $report->location }}</td>
                    <td>{{ $report->description }}</td>
                    <td>
                        <span class="badge bg-{{ $report->status == 'pending' ? 'warning' : 'success' }}">
                            {{ ucfirst($report->status) }}
                        </span>
                    </td>
                    <td>{{ $report->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.report.view', $report->id) }}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>
@endsection
