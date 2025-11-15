@extends('layout.app')

@section('title', 'Settings')

@section('styles')
<style>
.settings-container { max-width: 900px; margin: 50px auto; font-family: 'Inter', sans-serif; color: #333; }
.card { background: #fff; padding: 20px; margin-bottom: 20px; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.08); transition: transform 0.3s; }
.card:hover { transform: translateY(-3px); }
.card h3 { margin-top: 0; color: #2E8B57; }
.btn-delete { display: inline-block; padding: 12px 20px; background: #B22222; color: #fff; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; transition: background 0.3s; }
.btn-delete:hover { background: #8B0000; }
</style>
@endsection

@section('content')
<div class="settings-container">
    <h1>Settings</h1>

    <div class="card">
        <h3>Account Info</h3>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
        <p><strong>Phone:</strong> {{ $user->phone ?? 'Not set' }}</p>
    </div>

    <div class="card">
        <h3>Danger Zone</h3>
        <p>Deleting your account is <strong>permanent</strong> and cannot be undone.</p>

        @if ($errors->has('password'))
            <p style="color:red">{{ $errors->first('password') }}</p>
        @endif

        <form action="{{ route('account.destroy') }}" method="POST" 
              onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone!');">
            @csrf
            @method('DELETE')
            <input type="password" name="password" placeholder="Enter your password" style="padding:8px; width:100%; max-width:300px; border-radius:6px; border:1px solid #ccc;" required>
            <br><br>
            <button type="submit" class="btn-delete">Delete Account</button>
        </form>
    </div>

    <div class="card">
        <h3>Password / Privacy / Notifications</h3>
        <p>Coming soon...</p>
    </div>
</div>
@endsection

