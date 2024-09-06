<x-dashboard.dashboard-layout>
    <x-table-header action="{{ route('kasir.search') }}" placeholder="Search by name" name="Payments">
    <x-toast />
    @if ($calls->isEmpty())
        <p>Tidak ada panggilan darurat.</p>
    @else
        <x-th :headers="['No', 'Patient Name', 'Coordinator Name', 'Status', 'Time Calls', 'Action']" />
        <tbody>
            @foreach ($calls as $index => $call)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <x-td>{{ $index + 1 }}</x-td>
                    <x-td>{{ $call->patient->name }}</x-td>
                    <x-td>{{ $call->coordinator->name }}</x-td>
                    <x-td>{{ $call->status }}</x-td>
                    <x-td>{{ $call->created_at }}</x-td>
                    <x-td>
                        <a href="{{ route('emergency_calls.updateStatus', [$call->id, 'resolved']) }}"
                            class="btn btn-success btn-sm">Selesai</a>
                        <a href="{{ route('emergency_calls.updateStatus', [$call->id, 'rejected']) }}"
                            class="btn btn-danger btn-sm">Tolak</a>
                    </x-td>
                </tr>
            @endforeach
        </tbody>
    @endif
    </x-table-header>
</x-dashboard.dashboard-layout>
