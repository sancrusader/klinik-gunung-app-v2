<div class="container">
    <h1>Pembayaran</h1>
    <form action="{{ route('payments.store', $queue->id) }}" method="POST">
        @csrf
        <p>Nomor Antrian: {{ $queue->queue_number }}</p>
        <p>Nama: {{ $queue->full_name }}</p>
        <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
    </form>
</div>
