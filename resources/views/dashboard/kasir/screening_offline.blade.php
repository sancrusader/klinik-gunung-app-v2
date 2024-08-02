<div class="container">
    <h1>Dashboard Kasir</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nomor Antrian</th>
                <th>Nama Lengkap</th>
                <th>Status Kesehatan</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($screenings as $screening)
                <tr>
                    <td>{{ $screening->queue_number }}</td>
                    <td>{{ $screening->full_name }}</td>
                    <td>{{ $screening->health_check_result }}</td>
                    <td>{{ $screening->payment_status ? 'Sudah Bayar' : 'Belum Bayar' }}</td>
                    <td>
                        <form action="{{ route('kasir.confirm', $screening->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary"
                                {{ $screening->payment_status ? 'disabled' : '' }}>Konfirmasi Pembayaran</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $screenings->links() }}
</div>
