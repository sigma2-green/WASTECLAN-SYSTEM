@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Manage Waste Collection</h2>

    <!-- Add New Schedule -->
    <div class="card p-4 shadow-sm mb-4">
        <h5>Add Collection Schedule</h5>

        <form action="{{ route('admin.schedule.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Area</label>
                <input type="text" class="form-control" name="area" required>
            </div>

            <div class="mb-3">
                <label>Collection Day</label>
                <select class="form-control" name="day" required>
                    <option>Monday</option><option>Tuesday</option>
                    <option>Wednesday</option><option>Thursday</option>
                    <option>Friday</option><option>Saturday</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Assign Collector</label>
                <select class="form-control" name="collector_id" required>
                    @foreach($collectors as $collector)
                        <option value="{{ $collector->id }}">{{ $collector->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Save Schedule</button>
        </form>
    </div>

    <!-- Existing Schedules Table -->
    <h4>Existing Schedules</h4>
    <table class="table table-bordered shadow-sm">
        <thead>
            <tr>
                <th>Area</th>
                <th>Day</th>
                <th>Collector</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->area }}</td>
                    <td>{{ $schedule->day }}</td>
                    <td>{{ $schedule->collector->name }}</td>
                    <td>
                        <a href="{{ route('admin.schedule.edit', $schedule->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.schedule.destroy', $schedule->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>
@endsection
