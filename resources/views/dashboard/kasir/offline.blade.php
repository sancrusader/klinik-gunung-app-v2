<div class="container">
    <h1>Dashboard Kasir</h1>

    <table class="table">
        <thead>
            <tr>
                <th>No. Antrian</th>
                <th>Nama</th>
                <th>Status Pembayaran</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($screenings as $screening)
                <tr>
                    <td>{{ $screening->queue_number }}</td>
                    <td>{{ $screening->full_name }}</td>
                    <td>{{ $screening->payment_status ? 'Paid' : 'Pending' }}</td>
                    <td>
                        @if (!$screening->payment_status && !$screening->payment_confirmed)
                            <form action="{{ route('kasir.confirmPayment', $screening->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $screenings->links() }}
</div>
