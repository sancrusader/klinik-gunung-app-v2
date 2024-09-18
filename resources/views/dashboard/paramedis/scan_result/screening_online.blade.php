<x-dashboard.dashboard-layout>
    <x-table-header action="" placeholder="Search by name" name="Screening Offline">
        <x-toast />
        <x-th :headers="['Full Name', 'Email', 'Address', 'Date Of Birth', 'Citizenship', 'Country']" />
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
            @foreach ($scans as $scan)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <x-td>
                        {{ $scan->full_name }}</x-td>
                    <x-td>
                        {{ $scan->email }}</x-td>
                    <x-td>
                        {{ $scan->address }}</x-td>
                    <x-td>

                        {{ $scan->date_of_birth }}
                    </x-td>
                    <x-td>

                        {{ $scan->citizenship }}
                    </x-td>
                    <x-td>

                        {{ $scan->country }}
                    </x-td>
                </tr>
            @endforeach
        </tbody>
    </x-table-header>
</x-dashboard.dashboard-layout>
