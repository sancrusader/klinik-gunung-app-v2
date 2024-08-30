<h1>Panggilan Darurat Masuk</h1>

@if ($calls->isEmpty())
    <p>Tidak ada panggilan darurat.</p>
@else
    <ul>
        @foreach ($calls as $call)
            <li>
                Panggilan dari: {{ $call->patient->name }}
                <a href="{{ route('emergency_calls.updateStatus', [$call->id, 'resolved']) }}">Tandai sebagai Selesai</a>
                <a href="{{ route('emergency_calls.updateStatus', [$call->id, 'rejected']) }}">Tolak</a>
            </li>
        @endforeach
    </ul>
@endif
