{{-- resources/views/collectors/routes.blade.php --}}
<h2>Routes</h2>
<ul>
    @foreach($routes as $route)
        <li>{{ $route->name }} - {{ $route->description }}</li>
    @endforeach
</ul>
