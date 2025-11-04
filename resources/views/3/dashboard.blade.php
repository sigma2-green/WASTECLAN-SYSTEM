@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<style>

</style>
<div style="padding: 100px; text-align:center;" class="back">
    <h1>Welcome, {{ Auth::user()->name ?? 'User' }} 👋</h1>
    <p style="margin-top:10px;">You are now logged in to your Waste Management System dashboard.</p>

    <div style="margin-top:40px;">
        <a href="#" style="background-color:darkgreen; color:white; padding:15px 30px; border-radius:10px; text-decoration:none;">
            View Reports
        </a>
        <a href="#" style="background-color:black; color:white; padding:15px 30px; border-radius:10px; text-decoration:none; margin-left:10px;">
            Manage Waste Points
        </a>
    </div>
</div>
@endsection

