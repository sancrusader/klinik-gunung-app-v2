<div class="container">
    <h1>Dashboard Paramedis</h1>

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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($screenings as $screening)
                <tr>
                    <td>{{ $screening->queue_number }}</td>
                    <td>{{ $screening->full_name }}</td>
                    <td>
                        <form action="{{ route('paramedis.confirm', $screening->id) }}" method="POST">
                            @csrf
                            <select name="health_check_result" class="form-control" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="tidak_didampingi">Tidak Didampingi</option>
                                <option value="butuh_pendamping">Butuh Pendamping</option>
                                <option value="butuh_dokter">Butuh Dokter</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Konfirmasi</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $screenings->links() }}
</div>
