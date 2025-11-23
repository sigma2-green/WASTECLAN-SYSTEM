@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">System Analytics</h2>

    <div class="row">

        <!-- Total Requests -->
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Total Waste Requests</h5>
                <h2>{{ $totalRequests }}</h2>
            </div>
        </div>

        <!-- Pending -->
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Pending Requests</h5>
                <h2>{{ $pending }}</h2>
            </div>
        </div>

        <!-- Completed -->
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Completed Collections</h5>
                <h2>{{ $completed }}</h2>
            </div>
        </div>

    </div>

    <hr class="my-4">

    <h4>Request Trends</h4>
    <div class="card p-4 shadow-sm">
        <p><i>Chart placeholder — e.g., line graph or bar chart</i></p>
    </div>

</div>
@endsection
