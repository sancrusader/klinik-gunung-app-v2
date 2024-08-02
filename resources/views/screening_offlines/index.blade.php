<div class="container">
    <h1>Screening Offline</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nomor Antrian</th>
                <th>Nama Lengkap</th>
                <th>Status Kesehatan</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($screenings as $screening)
                <tr>
                    <td>{{ $screening->queue_number }}</td>
                    <td>{{ $screening->full_name }}</td>
                    <td>{{ $screening->health_check_result ?? 'Belum Diperiksa' }}</td>
                    <td>{{ $screening->payment_status ? 'Sudah Bayar' : 'Belum Bayar' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $screenings->links() }}
</div>
