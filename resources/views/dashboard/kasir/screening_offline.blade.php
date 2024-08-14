<x-dashboard.dashboard-layout>
    <x-slot:title>Screening Payment</x-slot:title>
    <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
        <main>
            <div
                class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
                <div class="w-full mb-1">
                    <div class="mb-4">
                        <nav class="flex mb-5" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                                <li class="inline-flex items-center">
                                    <a href="#"
                                        class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                        <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                            </path>
                                        </svg>
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500"
                                            aria-current="page">List</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Pembayaran</h1>
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
                                                <th scope="col"
                                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Status
                                                </th>
                                                <th scope="col"
                                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Status Pembayaran
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
                                                    <td
                                                        class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{ $screening->payment_status ? 'Sudah Bayar' : 'Belum Bayar' }}
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('kasir.confirm', $screening->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                                                {{ $screening->payment_status ? 'disabled' : '' }}>Konfirmasi
                                                                Pembayaran</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{ $screenings->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-dashboard.dashboard-layout>
