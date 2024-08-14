<div class="container">
    <h1>Pendaftaran Manual Pasien</h1>

    <form action="{{ route('admin.register-patients-manual') }}" method="POST">
        @csrf

        <div id="patients-list">
            <div class="patient-entry mb-4 p-4 border rounded-lg">
                <h4>Pasien 1</h4>
                <div class="form-group">
                    <label for="patients[0][full_name]">Nama Lengkap</label>
                    <input type="text" name="patients[0][full_name]" class="form-control" required>
                </div>
                <!-- Tambahkan input lainnya sesuai kebutuhan -->
            </div>
        </div>

        <button type="button" class="btn btn-secondary mt-3" onclick="addPatient()">Tambah Pasien</button>
        <button type="submit" class="btn btn-primary mt-3">Daftarkan Semua Pasien</button>
    </form>
</div>

<script>
    let patientCount = 1;

    function addPatient() {
        const newPatient = document.querySelector('.patient-entry').cloneNode(true);
        newPatient.querySelector('h4').textContent = 'Pasien ' + (patientCount + 1);
        newPatient.querySelectorAll('input').forEach(input => {
            const name = input.getAttribute('name').replace(/\d+/, patientCount);
            input.setAttribute('name', name);
            input.value = '';
        });
        document.getElementById('patients-list').appendChild(newPatient);
        patientCount++;
    }
</script>
