<div class="container">
    <h1>Daftar Antrian</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nomor Antrian</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($queues as $queue)
                <tr>
                    <td>{{ $queue->queue_number }}</td>
                    <td>{{ $queue->full_name }}</td>
                    <td>{{ $queue->status }}</td>
                    <td>
                        @if ($queue->status === 'pending')
                            <a href="{{ route('queues.confirmPayment', $queue->id) }}" class="btn btn-primary">Konfirmasi
                                Pembayaran</a>
                        @else
                            <span class="badge badge-success">Sudah Dibayar</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $queues->links() }}
</div>
