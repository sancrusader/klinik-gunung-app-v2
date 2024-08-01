<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Jadwal</title>
</head>

<body>
    <h1>Atur Jadwal Staf</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('manajer.schedule.store') }}" method="POST">
        @csrf
        <label for="staff_id">Staf:</label>
        <select name="staff_id" id="staff_id">
            @foreach ($staff as $staffMember)
                <option value="{{ $staffMember->id }}">{{ $staffMember->name }}</option>
            @endforeach
        </select>
        <br>
        <label for="shift">Shift:</label>
        <input type="text" name="shift" id="shift">
        <br>
        <label for="schedule_date">Tanggal:</label>
        <input type="date" name="schedule_date" id="schedule_date">
        <br>
        <label for="role">Peran:</label>
        <input type="text" name="role" id="role">
        <br>
        <button type="submit">Simpan Jadwal</button>
    </form>
</body>

</html>
