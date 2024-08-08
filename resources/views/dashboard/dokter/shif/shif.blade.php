<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter</title>
</head>

<body>
    <h1>Dashboard Dokter</h1>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <h2>Jadwal Mendatang</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Shift</th>
                <th>Peran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->schedule_date }}</td>
                    <td>{{ $schedule->shift }}</td>
                    <td>{{ $schedule->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
