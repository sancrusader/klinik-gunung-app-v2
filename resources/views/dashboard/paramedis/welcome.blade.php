<h1>Dashboard Paramedis</h1>

<x-alert />

<table class="table">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Date of Birth</th>
            <th>Mountain</th>
            <th>Citizenship</th>
            <th>Country</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Queue Number</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($scans as $scan)
            <tr>
                <td>{{ $scan->full_name }}</td>
                <td>{{ $scan->date_of_birth }}</td>
                <td>{{ $scan->mountain }}</td>
                <td>{{ $scan->citizenship }}</td>
                <td>{{ $scan->country }}</td>
                <td>{{ $scan->address }}</td>
                <td>{{ $scan->phone }}</td>
                <td>{{ $scan->email }}</td>
                <td>{{ $scan->queue_number }}</td>
                <td>{{ $scan->status }}</td>
                <td>
                    @foreach ($scans as $scan)
                        <form action="{{ route('paramedis.processHealthCheck', $scan->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="scan_id" value="{{ $scan->id }}">
                            <select name="health_status" required>
                                <option value="">Pilih Status</option>
                                <option value="sehat">Sehat</option>
                                <option value="tidak sehat">Tidak Sehat</option>
                            </select>
                            <button type="submit">Kirim</button>
                        </form>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
