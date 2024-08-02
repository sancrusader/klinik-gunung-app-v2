<!DOCTYPE html>
<html>

<head>
    <title>Pemeriksaan Kesehatan</title>
</head>

<body>
    <h1>Pemeriksaan Kesehatan</h1>
    <form action="{{ route('screening_offlines.update_health_check', $screening->id) }}" method="POST">
        @csrf
        <label for="health_check_result">Hasil Pemeriksaan:</label>
        <select id="health_check_result" name="health_check_result" required>
            <option value="sehat">Sehat</option>
            <option value="tidak sehat">Tidak Sehat</option>
        </select>
        <button type="submit">Simpan</button>
    </form>
</body>

</html>
