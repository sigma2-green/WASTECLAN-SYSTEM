@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>Sorting Guides</h2>
    <div class="row">
        @forelse($guides as $guide)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $guide->title }}</h5>
                        <p class="card-text">{{ $guide->description }}</p>
                        <ul>
                            @foreach($guide->steps as $step)
                                <li>{{ $step }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <p>No sorting guides available.</p>
        @endforelse
    </div>
</div>
@endsection


