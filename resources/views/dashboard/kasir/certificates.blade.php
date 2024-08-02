<div class="container">
    <h1>Daftar Sertifikat</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Pendaki</th>
                <th>Tanggal Lahir</th>
                <th>Gunung</th>
                <th>Negara</th>
                <th>QR Code</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($screenings as $screening)
                <tr>
                    <td>{{ $screening->full_name }}</td>
                    <td>{{ $screening->date_of_birth }}</td>
                    <td>{{ $screening->mountain }}</td>
                    <td>{{ $screening->country }}</td>
                    <td>
                        @if ($screening->qr_code_url)
                            <img src="{{ $screening->qr_code_url }}" alt="QR Code" width="50">
                        @endif
                    </td>
                    <td>
                        @if ($screening->certificate_path)
                            <a href="{{ asset('storage/' . $screening->certificate_path) }}" target="_blank"
                                class="btn btn-primary">Lihat Sertifikat</a>
                        @else
                            <span>Belum ada sertifikat</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $screenings->links() }}
</div>
