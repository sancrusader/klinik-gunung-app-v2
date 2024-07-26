<x-dashboard-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Konsultasi</h1>

        <h2 class="text-xl font-semibold mb-4">Konsultasi yang Diajukan</h2>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Pendaki</th>
                    <th class="py-2 px-4 border-b">Pesan</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consultations as $consultation)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $consultation->hiker->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $consultation->message }}</td>
                        <td class="py-2 px-4 border-b">{{ $consultation->status }}</td>
                        <td class="py-2 px-4 border-b">
                            @if ($consultation->status == 'pending')
                                <form action="{{ route('dokter.consultasi.complete', $consultation->id) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2">Selesaikan</button>
                                </form>
                            @else
                                <span class="text-green-500">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-dashboard-layout>
