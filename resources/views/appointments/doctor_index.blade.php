<h1>My Appointments</h1>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

<ul>
    @foreach ($appointments as $appointment)
        <li>
            <a href="{{ route('dokter.appointments.show', $appointment->id) }}">
                Consultation with {{ $appointment->user->name }} on {{ $appointment->scheduled_at ?? 'Unscheduled' }}
            </a>
            - Status: {{ $appointment->status }}
        </li>
    @endforeach
</ul>
