<x-dashboard.dashboard-layout>
    <x-slot:title>History Screening Offline</x-slot:title>
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Screening Offline
                    History
                </h1>
            </div>
            <x-toast />
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
                                        <th scope="col"
                                            class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            Status
                                        </th>
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
                                                {{ $screening->health_check_result }}
                                            </td>
                                            <td>
                                                <a href="{{ route('screeningOffline.edit', $screening->id) }}"
                                                    class="btn btn-warning">Edit</a>
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
</x-dashboard.dashboard-layout>
