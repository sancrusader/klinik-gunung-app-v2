<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
</head>

<body>
    <h1>Laporan</h1>

    <form action="{{ route('manajer.report.generate') }}" method="POST">
        @csrf
        <label for="type">Jenis Laporan:</label>
        <select name="type" id="type">
            <option value="weekly">Mingguan</option>
            <option value="monthly">Bulanan</option>
        </select>
        <br>
        <label for="start_date">Tanggal Mulai:</label>
        <input type="date" name="start_date" id="start_date">
        <br>
        <label for="end_date">Tanggal Akhir:</label>
        <input type="date" name="end_date" id="end_date">
        <br>
        <button type="submit">Buat Laporan</button>
    </form>

    <h2>Daftar Laporan</h2>
    <ul>
        @foreach ($reports as $report)
            <li>
                {{ $report->type }}: {{ $report->start_date }} - {{ $report->end_date }}
                <p>{{ $report->content }}</p>
            </li>
        @endforeach
    </ul>
</body>

</html>
