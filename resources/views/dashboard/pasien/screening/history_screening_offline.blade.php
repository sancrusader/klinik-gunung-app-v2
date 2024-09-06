<x-dashboard.dashboard-layout>
    <x-table-header action="{{ route('pasien.search') }}" placeholder="Search by name" name="Screening Offline">
        <x-toast />
        {{-- Table Header --}}
        <x-th :headers="['Queue Number', 'Full Name', 'Status', 'Payment Status']" />
        {{-- Button Modal  --}}
        <x-modal.button id="create-screening-offline" buttonName="New Screening Offline" />
        {{-- Table Body --}}
        <tbody>
            @foreach ($screenings as $screening)
                <tr>
                    <x-td>{{ $screening->queue_number }}</x-td>
                    <x-td>{{ $screening->full_name }}</x-td>
                    <x-td>
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
                            {{ 'Checking' }}
                        @endif
                    </x-td>
                    <x-td>
                        @if ($screening->payment_status)
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500">
                                {{ 'Paid' }}
                            </span>
                        @else
                            <span
                                class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-red-400 border border-red-100 dark:border-red-500">
                                {{ 'Pending Payment' }}
                            </span>
                        @endif
                    </x-td>
                </tr>
            @endforeach
        </tbody>
    </x-table-header>

    {{-- Modal Membuat Screening --}}
    <div id="create-screening-offline" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Create New Screening Offline
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="create-screening-offline">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.dashboard-layout>
