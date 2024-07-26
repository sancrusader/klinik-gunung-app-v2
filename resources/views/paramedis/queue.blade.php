<!-- resources/views/paramedis/queue.blade.php -->
<x-dashboard-layout>
    <h1>Antrian</h1>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <ul>
        @foreach ($scans as $scan)
            <li>
                {{ $scan->name }} - {{ $scan->queue_number }}
                <a href="{{ route('paramedis.healthcheck.create', $scan->id) }}">Proses</a>
            </li>
        @endforeach
    </ul>
@endsection

</x-dashboard-layout>
