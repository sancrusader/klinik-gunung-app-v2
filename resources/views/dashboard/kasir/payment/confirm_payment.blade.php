<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <h1>Konfirmasi Pembayaran</h1>

    <x-alert />

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>Mountain</th>
                <th>Citizenship</th>
                <th>Country</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>Queue Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($screenings as $screening)
                <tr>
                    <td>{{ $screening->id }}</td>
                    <td>{{ $screening->full_name }}</td>
                    <td>{{ $screening->date_of_birth }}</td>
                    <td>{{ $screening->mountain }}</td>
                    <td>{{ $screening->citizenship }}</td>
                    <td>{{ $screening->country }}</td>
                    <td>{{ $screening->address }}</td>
                    <td>{{ $screening->phone }}</td>
                    <td>{{ $screening->email }}</td>
                    <td>{{ $screening->payment_status }}</td>
                    <td>{{ $screening->queue_number }}</td>
                    <td>
                        <form action="{{ route('kasir.confirmPayment', $screening->id) }}" method="POST">
                            @csrf
                            <button type="submit">Konfirmasi Pembayaran</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $screenings->links() }}
</body>

</html>
