<!DOCTYPE html>
<html>

<head>
    <title>Pembayaran</title>
</head>

<body>
    <h1>Pembayaran</h1>
    <form action="{{ route('screening_offlines.process_payment', $screening->id) }}" method="POST">
        @csrf
        <button type="submit">Bayar dan Dapatkan Sertifikat</button>
    </form>
</body>

</html>
