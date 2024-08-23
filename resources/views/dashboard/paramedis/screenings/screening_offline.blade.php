{{-- <div class="container">
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
</div> --}}
<x-dashboard.dashboard-layout>
    <x-slot:title>Screenings Offline</x-slot:title>
    <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
        <main>
            <div
                class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
                <div class="w-full mb-1">
                    <div class="mb-4">
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Screening Offline
                        </h1>
                    </div>

                    <x-alert />
                    <div class="flex flex-col">
                        <div class="overflow-x-auto">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden shadow">
                                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                                        <thead class="bg-gray-100 dark:bg-gray-700">
                                            <tr>
                                                <th scope="col"
                                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Nomor Antrian
                                                </th>
                                                <th scope="col"
                                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Nama Lengkap
                                                </th>
                                                <th></th>
                                                <th scope="col"
                                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Aksi
                                                </th>
                                        <tbody>
                                            @foreach ($screenings as $screening)
                                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <td
                                                        class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{ $screening->queue_number }}
                                                    </td>
                                                    <td
                                                        class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{ $screening->full_name }}
                                                    </td>
                                                    <td
                                                        class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <td>
                                                        <form action="{{ route('paramedis.confirm', $screening->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <select name="health_check_result" class="form-control"
                                                                required>
                                                                <option value="" disabled selected>Pilih Status
                                                                </option>
                                                                <option value="sehat">Tidak Didampingi (Sehat)
                                                                </option>
                                                                <option value="butuh_pendamping">Butuh Pendamping
                                                                </option>
                                                                <option value="butuh_dokter">Butuh Dokter</option>
                                                            </select>
                                                            <button type="submit"
                                                                class="btn btn-primary mt-2">Konfirmasi</button>
                                                        </form>
                                                    </td>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-dashboard.dashboard-layout>
