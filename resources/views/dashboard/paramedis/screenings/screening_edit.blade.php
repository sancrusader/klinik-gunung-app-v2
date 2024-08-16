<div class="container">
    <h1>Edit Hasil Screening</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('screeningOffline.update', $screening->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="health_check_result">Status Kesehatan</label>
            <select name="health_check_result" class="form-control" required>
                <option value="" disabled>Pilih Status</option>
                <option value="tidak_didampingi"
                    {{ $screening->health_check_result == 'tidak_didampingi' ? 'selected' : '' }}>Tidak Didampingi
                </option>
                <option value="butuh_pendamping"
                    {{ $screening->health_check_result == 'butuh_pendamping' ? 'selected' : '' }}>Butuh Pendamping
                </option>
                <option value="butuh_dokter" {{ $screening->health_check_result == 'butuh_dokter' ? 'selected' : '' }}>
                    Butuh Dokter</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Perbarui</button>
    </form>
</div>
