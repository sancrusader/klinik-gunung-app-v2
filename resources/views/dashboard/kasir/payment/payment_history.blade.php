<div class="container">
    <h1>Riwayat Pembayaran</h1>

    <table class="table">
        <thead>
            <tr>
                <th>No. Antrian</th>
                <th>Nama</th>
                <th>Status Pembayaran</th>
                <th>Tanggal Pembayaran</th>
                <th>Sertifikat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paidScreenings as $screening)
                <tr>
                    <td>{{ $screening->queue_number }}</td>
                    <td>{{ $screening->full_name }}</td>
                    <td>{{ $screening->payment_status ? 'Sudah Bayar' : 'Belum Bayar' }}</td>
                    <td>{{ $screening->updated_at->format('d-m-Y H:i') }}</td>
                    <td>
                        @if ($screening->certificate_path)
                            <a href="{{ asset($screening->certificate_path) }}" target="_blank">Lihat Sertifikat</a>
                        @else
                            Belum tersedia
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
