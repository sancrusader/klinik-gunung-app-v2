<!DOCTYPE html>
<html>

<head>
    <title>Pendaftaran Screening</title>
</head>

<body>
    <h1>Pendaftaran Screening Offline</h1>
    <form action="{{ route('screening-offline.store') }}" method="POST">
        @csrf
        <label for="full_name">Nama Lengkap:</label>
        <input type="text" id="full_name" name="full_name" required>
        <button type="submit">Daftar</button>
    </form>
</body>

</html>
