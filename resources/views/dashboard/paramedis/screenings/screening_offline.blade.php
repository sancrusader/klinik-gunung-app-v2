<x-dashboard.dashboard-layout>
    <x-slot:title>Screenings Offline</x-slot:title>

    {{-- Tabel Header --}}
    <x-table-header action="{{ route('paramedis.search') }}" placeholder="Search by name" name="Screening Offline">
        <x-toast />
        <x-th :headers="[
            'Full Name',
            'Age',
            'gender',
            'Contact Number',
            'Planned Hiking Date',
            'Previous Hikes Count',
            'Detail',
        ]" />

        {{-- Tabel Body --}}
        <tbody id="#screening-results">
            @foreach ($screenings as $screening)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <x-td>
                        {{ $screening->full_name }}
                    </x-td>
                    <x-td>
                        {{ $screening->age }}
                    </x-td>
                    <x-td>
                        {{ $screening->gender }}
                    </x-td>
                    <x-td>
                        {{ $screening->contact_number }}
                    </x-td>
                    <x-td>
                        {{ $screening->planned_hiking_date }}
                    </x-td>
                    <x-td>
                        {{ $screening->previous_hikes_count }} Meters
                    </x-td>
                    <x-td> <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                            href="{{ route('paramedis.screeningOffline.Detail', $screening->id) }}">
                            Quishioner
                        </a></x-td>
                    </form>
                </tr>
            @endforeach
        </tbody>
        {{-- Table Body --}}
    </x-table-header>
    {{-- /Table Header --}}

    {{-- Modal Confirm --}}
    <div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full"
        id="modal-confirm">
        <div class="relative w-full h-full max-w-md px-4 md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex justify-end p-2">
                    <button type="submit"
                        onclick="event.preventDefault(); document.getElementById('modal-confirm').submit();"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                        data-modal-toggle="modal-confirm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 pt-0 text-center">
                    <svg class="w-16 h-16 mx-auto text-blue-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-5 mb-6 text-lg text-gray-500 dark:text-gray-400">Apakah kamu yakin?</h3>
                    <a href="#"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Yes, I'm sure
                    </a>
                    <a href=""
                        class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                        data-modal-toggle="modal-confirm">
                        No, cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- /Modal Confirm --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var query = $(this).val();
                $.ajax({
                    url: "{{ route('paramedis.ScreeningOffline') }}",
                    type: "GET",
                    data: {
                        'query': query
                    },
                    success: function(data) {
                        $('#screening-results').html(data);
                    }
                });
            });
        });
    </script>

</x-dashboard.dashboard-layout>
