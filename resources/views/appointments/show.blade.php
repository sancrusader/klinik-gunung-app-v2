<x-dashboard.dashboard-layout>
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

    <a href="{{ route('pasien.appointments.index') }}">Back to Appointments</a>
</x-dashboard.dashboard-layout>
