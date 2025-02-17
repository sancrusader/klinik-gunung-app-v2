<h1>History Screening Offline</h1>
@if (session('success'))
    <div class="mb-4 text-green-600">
        {{ session('success') }}
@endif
<table>
    <thead>
        <tr>
            <th>No. Antrian</th>
            <th>Nama</th>
            <th>Hasil Pemeriksaan</th>
            <th>Status Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($screenings as $screening)
            <tr>
                <td>{{ $screening->queue_number }}</td>
                <td>{{ $screening->full_name }}</td>
                <td>{{ $screening->health_check_result }}</td>
                <td>{{ $screening->payment_status ? 'Sudah Bayar' : 'Belum Bayar' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
