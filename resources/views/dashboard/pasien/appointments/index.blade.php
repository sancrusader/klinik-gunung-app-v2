{{-- <x-dashboard.dashboard-layout>
    <x-slot:title>Appointments</x-slot:title>


    @if (Auth::user()->role === 'pasien')
        <a href="{{ route('pasien.appointments.create') }}">Create Appointment</a>
    @endif
    @if ($appointments->isEmpty())
        <p>No appointments found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Doctor</th>
                    <th>Scheduled At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->id }}</td>
                        <td>{{ $appointment->user->name }}</td>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->scheduled_at }}</td>
                        <td>{{ $appointment->status }}</td>
                        <td>
                            @if (Auth::user()->role === 'dokter' && $appointment->status === 'pending')
                                <form action="{{ route('dokter.appointments.accept', $appointment->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit">Accept</button>
                                </form>
                            @endif
                            @if (Auth::user()->role === 'dokter' && $appointment->status === 'confirmed')
                                <form action="{{ route('dokter.appointments.complete', $appointment->id) }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit">Complete</button>
                                </form>
                            @endif
                            @if (Auth::user()->role === 'pasien')
                                <a href="{{ route('pasien.appointments.show', $appointment->id) }}">View</a>
                                <a href="{{ route('pasien.appointments.edit', $appointment->id) }}">Edit</a>
                                <form action="{{ route('pasien.appointments.destroy', $appointment->id) }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-dashboard.dashboard-layout> --}}
{{-- <h1>My Appointments</h1>

<ul>
    @foreach ($appointments as $appointment)
        <li>
            <a href="{{ route('dokter.appointments.show', $appointment->id) }}">
                Consultation with {{ $appointment->user->name }} on {{ $appointment->scheduled_at ?? 'Unscheduled' }}
            </a>
            - Status: {{ $appointment->status }}
        </li>
    @endforeach
</ul> --}}
<x-dashboard.dashboard-layout>
    <x-slot:title>Appointments</x-slot:title>
    <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
        <main>
            <div
                class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
                <div class="w-full mb-1">
                    <div class="mb-4">
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Appointments</h1>
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
                                                    Dokter
                                                </th>
                                                <th scope="col"
                                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Scheduled At
                                                </th>
                                                <th scope="col"
                                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Unscheduled Reason
                                                </th>
                                                <th scope="col"
                                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Status
                                                </th>
                                                <th scope="col"
                                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">

                                                </th>
                                                <th scope="col"
                                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Aksi
                                                </th>
                                        <tbody>
                                            @if ($appointments->isEmpty())
                                                <p>No appointments found.</p>
                                                @foreach ($appointments as $appointment)
                                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                        <td
                                                            class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ $appointment->doctor->name }}
                                                        </td>
                                                        <td
                                                            class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ $appointment->scheduled_at }}
                                                        </td>
                                                        <td
                                                            class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ $appointment->unscheduled_reason }}
                                                        </td>
                                                        <td
                                                            class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ $appointment->status }}
                                                        </td>
                                                        <td>
                                                            @if (Auth::user()->role === 'dokter' && $appointment->status === 'pending')
                                                                <form
                                                                    action="{{ route('dokter.appointments.accept', $appointment->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    <button type="submit">Accept</button>
                                                                </form>
                                                            @endif
                                                            @if (Auth::user()->role === 'dokter' && $appointment->status === 'confirmed')
                                                                <form
                                                                    action="{{ route('dokter.appointments.complete', $appointment->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    <button type="submit">Complete</button>
                                                                </form>
                                                            @endif
                                                            @if (Auth::user()->role === 'pasien')
                                                                <a
                                                                    href="{{ route('pasien.appointments.show', $appointment->id) }}">View</a>
                                                                <a
                                                                    href="{{ route('pasien.appointments.edit', $appointment->id) }}">Edit</a>
                                                                <form
                                                                    action="{{ route('pasien.appointments.destroy', $appointment->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit">Delete</button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                                                href="{{ route('dokter.appointments.show', $appointment->id) }}">
                                                                Detail
                                                            </a>
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
        </main>
    </div>
    {{-- <div id="confirm-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Tombol untuk menutup modal -->
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="confirm-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        confirm
                        this appointment?</h3>
                    <form action="{{ route('dokter.appointments.confirm', $appointment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Yes, Confirm
                        </button>
                        <button type="button" data-modal-hide="confirm-modal"
                            class="py-2.5 px-5 ml-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                            Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</x-dashboard.dashboard-layout>
