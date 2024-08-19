<!DOCTYPE html>
<html>

<head>
    <title>Pilih Periode Laporan</title>
</head>

<body>
    <h1>Pilih Periode Laporan</h1>
    <form action="{{ route('report.pdf') }}" method="GET">
        @csrf
        <label for="periode">Periode:</label>
        <select name="periode" id="periode">
            <option value="weekly">Mingguan</option>
            <option value="monthly">Bulanan</option>
        </select>

        <button type="submit">Generate PDF</button>
    </form>
</body>

</html>
