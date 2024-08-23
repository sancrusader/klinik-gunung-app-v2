<!-- resources/views/ktp/upload.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload KTP</title>
</head>

<body>
    <h1>Upload KTP untuk Scan OCR</h1>
    <form action="{{ route('ktp.scan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="ktp_image">Pilih gambar KTP:</label>
        <input type="file" name="ktp_image" id="ktp_image" accept="image/*" required>
        <button type="submit">Upload dan Scan</button>
    </form>
</body>

</html>

{{ dd(env('GOOGLE_APPLICATION_CREDENTIALS')) }}
