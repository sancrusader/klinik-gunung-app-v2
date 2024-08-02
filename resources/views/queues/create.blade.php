<div class="container">
    <h1>Daftar Nomor Antrian</h1>
    <form action="{{ route('queues.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="full_name">Nama Lengkap:</label>
            <input type="text" class="form-control" id="full_name" name="full_name" required>
        </div>
        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
</div>
