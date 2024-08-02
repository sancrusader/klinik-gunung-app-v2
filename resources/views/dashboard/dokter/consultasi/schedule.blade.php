<x-dashboard.dashboard-layout>
    <h1>Jadwal Konsultasi Anda</h1>

    @if ($consultations->isEmpty())
        <p>Tidak ada jadwal konsultasi saat ini.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Konsultasi</th>
                    <th>Pendaki</th>
                    <th>Tanggal Jadwal</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Alasan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consultations as $consultation)
                    <tr>
                        <td>{{ $consultation->id }}</td>
                        <td>{{ $consultation->user->name }}</td>
                        <td>{{ $consultation->schedule->date }}</td>
                        <td>{{ $consultation->schedule->start_time }}</td>
                        <td>{{ $consultation->schedule->end_time }}</td>
                        <td>{{ $consultation->reason }}</td>
                        <td>{{ ucfirst($consultation->status) }}</td>
                        <td>
                            @if ($consultation->status === 'pending')
                                <form action="{{ route('dokter.complete', $consultation->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">Tandai Selesai</button>
                                </form>
                            @else
                                <span class="text-muted">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    </div>
</x-dashboard.dashboard-layout>
