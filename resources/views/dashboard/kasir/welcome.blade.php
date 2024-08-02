<div class="container">
    <h1>Dashboard Kasir</h1>
    <a href="{{ route('kasir.certificates') }}" class="btn btn-primary">Lihat Sertifikat</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Pendaki</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($screenings as $screening)
                <tr>
                    <td>{{ $screening->full_name }}</td>
                    <td>{{ $screening->payment_status ? 'Sudah Dibayar' : 'Belum Dibayar' }}</td>
                    <td>
                        @if (!$screening->payment_confirmed)
                            <form action="{{ route('kasir.confirmPayment', $screening->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
                            </form>
                        @else
                            <span>Pembayaran telah dikonfirmasi</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $screenings->links() }}
</div>
