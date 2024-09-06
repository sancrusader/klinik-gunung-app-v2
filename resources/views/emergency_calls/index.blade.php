<x-dashboard.dashboard-layout>
    <x-table-header action="" placeholder="Search by name" name="Emergency Respone">
        <x-th :headers="['No', 'Call From', 'accept', 'Rejected', 'Resolved']" />
        @if ($calls->isEmpty())
            <p>Tidak ada panggilan darurat.</p>
        @else
            @foreach ($calls as $index => $call)
                <tbody>
                    <x-td>{{ $index + 1 }}</x-td>
                    <x-td>{{ $call->patient->name }}</x-td>
                    <x-td><a class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                            href="{{ route('emergency_calls.updateStatus', [$call->id, 'accpet']) }}">
                            Accept
                        </a>
                    </x-td>
                        {{-- <x-td><a class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                href="{{ route('emergency_calls.updateStatus', [$call->id, 'resolved']) }}">
                                Resolved
                            </a>
                        </x-td> --}}
                        <x-td>
                            <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                href="{{ route('emergency_calls.updateStatus', [$call->id, 'rejected']) }}">
                                Reject
                            </a>
                        </x-td>
                </tbody>
            @endforeach
            </ul>
        @endif
    </x-table-header>
</x-dashboard.dashboard-layout>
