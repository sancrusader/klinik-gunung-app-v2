<x-dashboard.dashboard-layout>
    <x-slot:title>Shif Paramedis</x-slot:title>
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Shift</h1>
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
                                            Tanggal
                                        </th>
                                        <th scope="col"
                                            class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            Shift
                                        </th>
                                        <th scope="col"
                                            class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            Peran
                                        </th>
                                <tbody>
                                    @foreach ($schedules as $schedule)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <td
                                                class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $schedule->schedule_date }}
                                            </td>
                                            <td
                                                class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $schedule->shift }}
                                            </td>
                                            <td
                                                class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $schedule->role }}
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
