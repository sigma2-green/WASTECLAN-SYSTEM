{{-- resources/views/collectors/bin.blade.php --}}
<h2>Bins</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bins as $bin)
            <tr>
                <td>{{ $bin->id }}</td>
                <td>{{ $bin->name }}</td>
                <td>{{ $bin->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>