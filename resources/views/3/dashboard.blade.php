@extends('layout.app')

@section('title', 'Resident Dashboard')

@section('content')
<div class="dashboard-page">
    <div class="dashboard-header">
        <h1>Welcome, {{ Auth::user()->name ?? 'User' }} 👋</h1>
        <p>You are now logged in to your Waste Management System dashboard.</p>
    </div>

    <div class="dashboard-buttons">
        <a href="{{ route('collect') }}" class="dashboard-btn collect">Request Collection</a>
        <a href="{{ route('sortings.index') }}" class="dashboard-btn sorting">Waste Sorting Guide</a>
        <a href="{{ route('incentives.index') }}" class="dashboard-btn incentives">View & Redeem Incentives</a>
        <a href="{{ route('issues') }}" class="dashboard-btn issues">Report an Issue</a>
    </div>
</div>
@endsection

@section('styles')
<style>
/* Dashboard container */
.dashboard-page {
    max-width: 900px;
    margin: 50px auto;
    padding: 30px 20px;
    font-family: 'Inter', sans-serif;
    text-align: center;
    color: #fff;
}

/* Header */
.dashboard-header h1 {
    font-size: 2rem;
    margin-bottom: 10px;
}

.dashboard-header p {
    margin-bottom: 40px;
    font-size: 1.1rem;
}

/* Buttons Grid */
.dashboard-buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 170px;
    justify-items: center;
}

/* Button Styles */
.dashboard-btn {
    width: 220px;
    padding: 15px 0;
    border-radius: 10px;
    text-decoration: none;
    color: white;
    font-weight: 600;
    text-align: center;
    transition: transform 0.2s, box-shadow 0.2s;
}

.dashboard-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.35);
}

/* Individual Colors */
.dashboard-btn.collect { background-color: #2E8B57; }
.dashboard-btn.sorting { background-color: #4682B4; }
.dashboard-btn.incentives { background-color: #DAA520; }
.dashboard-btn.issues { background-color: #B22222; }

/* Responsive tweaks */
@media (max-width: 600px) {
    .dashboard-buttons {
        grid-template-columns: 1fr; /* stack vertically on small screens */
    }

    .dashboard-btn {
        width: 100%; /* full width */
    }
}
</style>
@endsection



