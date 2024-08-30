<x-dashboard.dashboard-layout>
    <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
        <main>
            <div class="p-4 bg-white border border-gray-200 shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <!-- Card header -->
                <div class="items-center justify-between lg:flex">
                    <div class="mb-4 lg:mb-0">
                        <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Screening Offline History</h3>
                        <span class="text-base font-normal text-gray-500 dark:text-gray-400">This is a list of latest
                            Screening</span>
                    </div>
                    <x-alert />
                    <div class="items-center sm:flex">
                        <div class="flex items-center">
                            <button type="button" data-modal-toggle="create-screening-offline"
                                class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Buat Screening
                            </button>
                            <!-- Dropdown menu -->
                        </div>
                    </div>
                </div>
                <!-- Table -->
                <div class="flex flex-col mt-6">
                    <div class="overflow-x-auto rounded-lg">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col"
                                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Nomor Antrian
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Nama Lengkap
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Status
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Status Pembayaran
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800">
                                        @foreach ($screenings as $screening)
                                            <tr>
                                                <td
                                                    class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                                    Antrian <span
                                                        class="font-semibold">{{ $screening->queue_number }}</span>
                                                </td>
                                                <td
                                                    class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                    {{ $screening->full_name }}
                                                </td>
                                                <td
                                                    class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                                    @if ($screening->payment_status == 1)
                                                        @if ($screening->health_check_result == 'sehat')
                                                            {{ 'Sehat' }}
                                                        @elseif($screening->health_check_result == null)
                                                            {{ 'Belum di Cek' }}
                                                        @elseif($screening->health_check_result == 'butuh_pendamping')
                                                            {{ 'Membutuhkan Pendamping' }}
                                                        @elseif($screening->health_check_result == 'butuh_dokter')
                                                            {{ 'Membutuhkan Dokter' }}
                                                        @endif
                                                    @elseif ($screening->payment_status == 0)
                                                        {{ 'Lakukan Pembayaran Terlebih Dahulu' }}
                                                    @endif
                                                </td>
                                                <td class="p-4 whitespace-nowrap">
                                                    @if ($screening->payment_status)
                                                        <span
                                                            class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500">
                                                            {{ 'Sudah Bayar' }}

                                                        </span>
                                                    @else
                                                        <span
                                                            class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-red-400 border border-red-100 dark:border-red-500">
                                                            {{ 'Belum Bayar' }}

                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Modal Membuat Screening --}}
                <div id="create-screening-offline" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Buat Antrian Screening Offline
                                </h3>
                                <button type="button"
                                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="authentication-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5">
                                <form class="space-y-4" action="{{ route('screening-offline.store') }}" method="POST">
                                    @csrf
                                    <div>
                                        <label for="full_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                                            Name</label>
                                        <input type="full_name" name="full_name" id="full_name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            value="{{ Auth::user()->name }}" required />
                                    </div>
                                    <button type="submit"
                                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buat
                                        Antrian</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-dashboard.dashboard-layout>
