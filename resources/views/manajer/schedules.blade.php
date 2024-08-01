<h1>Manage Staff Schedules</h1>

<h2>Staff List</h2>
<ul>
    @foreach ($staff as $user)
        <li>{{ $user->name }}</li>
    @endforeach
</ul>

<h2>Create New Schedule</h2>
<form action="{{ route('manajer.schedules.store') }}" method="POST">
    @csrf
    <label for="staff_id">Staff:</label>
    <select name="staff_id" id="staff_id">
        @foreach ($staff as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>

    <label for="schedule_date">Date:</label>
    <input type="date" name="schedule_date" id="schedule_date" required>

    <label for="shift">Shift:</label>
    <input type="text" name="shift" id="shift" required>

    <button type="submit">Create Schedule</button>
</form>

<h2>Schedules</h2>
<table border="1">
    <thead>
        <tr>
            <th>Staff Name</th>
            <th>Schedule Date</th>
            <th>Shift</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($schedules as $schedule)
            <tr>
                <td>{{ $schedule->user->name }}</td>
                <td>{{ $schedule->schedule_date }}</td>
                <td>{{ $schedule->shift }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
