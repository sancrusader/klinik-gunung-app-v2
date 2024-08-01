<h1>Appointment Details</h1>

<div>
    <strong>User ID:</strong> {{ $appointment->user_id }}
</div>
<div>
    <strong>Doctor ID:</strong> {{ $appointment->doctor_id }}
</div>
<div>
    <strong>Scheduled At:</strong> {{ $appointment->scheduled_at }}
</div>
<div>
    <strong>Unscheduled Reason:</strong> {{ $appointment->unscheduled_reason }}
</div>
<div>
    <strong>Status:</strong> {{ $appointment->status }}
</div>

@if ($appointment->status == 'pending')
    <form action="{{ route('dokter.appointments.confirm', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit">Confirm</button>
    </form>
@endif

@if ($appointment->status == 'confirmed')
    <form action="{{ route('dokter.appointments.complete', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit">Complete</button>
    </form>
@endif

<a href="{{ route('dokter.appointments.index') }}">Back to Appointments</a>
