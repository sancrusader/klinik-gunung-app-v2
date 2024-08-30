    <h1>Daftar Panggilan Darurat</h1>

    @if ($calls->isEmpty())
        <p>Tidak ada panggilan darurat.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Pasien</th>
                    <th>Koordinator Penyelamatan</th>
                    <th>Status</th>
                    <th>Waktu Panggilan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($calls as $index => $call)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $call->patient->name }}</td>
                        <td>{{ $call->coordinator->name }}</td>
                        <td>{{ $call->status }}</td>
                        <td>{{ $call->created_at }}</td>
                        <td>

                            <a href="{{ route('emergency_calls.updateStatus', [$call->id, 'resolved']) }}"
                                class="btn btn-success btn-sm">Selesai</a>
                            <a href="{{ route('emergency_calls.updateStatus', [$call->id, 'rejected']) }}"
                                class="btn btn-danger btn-sm">Tolak</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
