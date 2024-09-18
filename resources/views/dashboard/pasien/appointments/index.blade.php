<x-dashboard.dashboard-layout>
    <x-table-header action="{{ route('pasien.search') }}" placeholder="Search by name, status, schedul, doctor.."
        name="Appointments">
        <x-toast />
        <div class="items-center sm:flex">
            <div class="flex items-center mb-4">
                <button type="button" data-modal-toggle="create-appoinments"
                    class=" inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd">
                        </path>
                    </svg>
                    Create New Appointments
                </button>
                <!-- Dropdown menu -->
            </div>
        </div>
        <x-th :headers="['Name', 'Doctor Name', 'Schedule At', 'Status', 'Action']" />
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
            @foreach ($appointments as $appointment)
                <tr>
                    <x-td>{{ $appointment->user->name }}</x-td>
                    <x-td>{{ $appointment->doctor->name }}</x-td>
                    <x-td>{{ $appointment->scheduled_at }}</x-td>
                    <x-td>{{ $appointment->status }}</x-td>
                    <x-td>
                        @if ($appointment->status != 'confirmed' && $appointment->status != 'completed')
                            <form id="delete-form" action="{{ route('pasien.appointments.destroy', $appointment->id) }}"
                                method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" data-modal-toggle="delete-appointment"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        @else
                            <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                href="{{ route('dokter.medical_records.edit', $appointment->id) }}">
                                Detail
                            </a>
                        @endif
                    </x-td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </x-table-header>

    <x-modal.delete id="delete-appointment" content="Delete Appointments?" />

    <div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full"
        id="create-appoinments">
        <div class="relative w-full h-full max-w-2xl px-4 md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                    <h3 class="text-xl font-semibold dark:text-white">
                        Create New Appointments
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                        data-modal-toggle="create-appoinments">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form action="{{ route('pasien.appointments.store') }}" method="POST">
                        @csrf
                        <div>
                            <input type="text" name="user_id" value="{{ Auth::user()->id }}" readonly hidden>
                        </div>
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="doctor_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor</label>

                                <select name="doctor_id" id="doctor_id"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Bonnie" required>
                                    @foreach ($doctors as $doctor)
                                        <option disabled selected>Select Doctor</option>
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="scheduled_at"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">With Schedule
                                    (Optional)</label>
                                <input type="datetime-local" name="scheduled_at" id="scheduled_at"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="unscheduled_reason"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Without
                                    Schedule (Optional)</label>
                                <input type="text" name="unscheduled_reason" id="unscheduled_reason"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukan Keluhan">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="position"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                                    Name</label>
                                <input type="text" name="position" id="position"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    value="{{ Auth::user()->name }}" readonly>
                            </div>
                            <input type="text" name="status" id="" hidden value="pending">
                        </div>
                </div>
                <!-- Modal footer -->
                <div class="items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
                    <button
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        type="submit">Buat Appointments</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-dashboard.dashboard-layout>
