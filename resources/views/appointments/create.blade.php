<x-dashboard.dashboard-layout>
    <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
        <main>
            <h1>Create Appointment</h1>
            <form action="{{ route('pasien.appointments.store') }}" method="POST">
                @csrf
                <div>
                    <label for="user_id">User ID:</label>
                    <input type="text" name="user_id" value="{{ Auth::user()->id }}" readonly>
                </div>
                <div>
                    <label for="doctor_id">Doctor ID:</label>
                    <select name="doctor_id" required>
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="scheduled_at">Scheduled At (optional):</label>
                    <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}">
                </div>
                <div>
                    <label for="unscheduled_reason">Unscheduled Reason (optional):</label>
                    <textarea name="unscheduled_reason">{{ old('unscheduled_reason') }}</textarea>
                </div>
                <button type="submit">Create Appointment</button>
            </form>
</x-dashboard.dashboard-layout>
