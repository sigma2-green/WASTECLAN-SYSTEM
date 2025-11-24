@extends('layout.app')

@section('content')
    <h2>Incentives for {{ $resident->user->name }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul>
        @forelse($incentives as $incentive)
            <li>
                <strong>Amount:</strong> {{ $incentive->amount }}<br>
                <strong>Description:</strong> {{ $incentive->description }}<br>
                <strong>Date:</strong> {{ $incentive->created_at->format('Y-m-d') }}
            </li>
        @empty
            <li>No incentives found.</li>
        @endforelse
    </ul>

    <hr>
    <h3>Add New Incentive</h3>
    <form method="POST" action="{{ route('residents.incentives.add', $resident) }}">
        @csrf
        <div>
            <label for="amount">Amount:</label>
            <input type="number" name="amount" id="amount" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <input type="text" name="description" id="description">
        </div>
        <button type="submit">Add Incentive</button>
    </form>
@endsection
