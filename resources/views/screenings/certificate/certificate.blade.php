<!DOCTYPE html>
<html>

<head>
    <title>Sertifikat Pemeriksaan Kesehatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f3f3;
        }

        .certificate {
            width: 80%;
            padding: 20px;
            border: 2px solid #000;
            background-color: #fff;
            text-align: center;
        }

        .certificate h1 {
            font-size: 24px;
        }

        .certificate p {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <h1>Sertifikat Pemeriksaan Kesehatan</h1>
        <p>Nama: {{ $full_name }}</p>
        <p>Tanggal Lahir: {{ $date_of_birth }}</p>
        <p>Gunung: {{ $mountain }}</p>
        <p>Kewarganegaraan: {{ $citizenship }}</p>
        <p>Negara: {{ $country }}</p>
        <p>Alamat: {{ $address }}</p>
        <p>Telepon: {{ $phone }}</p>
        <p>Email: {{ $email }}</p>
        <p>Tanggal: {{ $date }}</p>
    </div>
</body>

</html>
