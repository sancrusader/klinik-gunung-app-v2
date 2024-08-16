<div class="container">
    <h1>Laporan Keuangan Screening</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Total Pendapatan: Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Jumlah Pasien yang Sudah Membayar: {{ $totalPaidPatients }}</h6>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nomor Antrian</th>
                <th scope="col">Nama Pasien</th>
                <th scope="col">Hasil Screening</th>
                <th scope="col">Jumlah Pembayaran</th>
                <th scope="col">Tanggal Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paidScreenings as $screening)
                <tr>
                    <td>{{ $screening->queue_number }}</td>
                    <td>{{ $screening->full_name }}</td>
                    <td>{{ $screening->health_check_result }}</td>
                    <td>Rp {{ number_format($screening->amount_paid, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($screening->updated_at)->format('d/m/Y g:i A') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
