    <div class="container">
        <h1>Jadwal yang Tersedia</h1>

        @if ($schedules->isEmpty())
            <p>Tidak ada jadwal yang tersedia saat ini.</p>
        @else
            <form action="{{ route('pendaki.store_schedule') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="schedule">Pilih Jadwal:</label>
                    <select name="schedule_id" id="schedule" class="form-control" required>
                        @foreach ($schedules as $schedule)
                            <option value="{{ $schedule->id }}">
                                {{ $schedule->date }} - {{ $schedule->start_time }} - {{ $schedule->end_time }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="doctor">Pilih Dokter:</label>
                    <select name="doctor_id" id="doctor" class="form-control" required>
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}">
                                {{ $doctor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="reason">Alasan Konsultasi:</label>
                    <input type="text" name="reason" id="reason" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Jadwalkan Konsultasi</button>
            </form>
        @endif
    </div>
