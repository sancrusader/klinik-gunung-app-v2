<x-dashboard.dashboard-layout>
    <x-slot:title>Appointments</x-slot:title>

    <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
        <main>
            <div class="px-4 pt-6">
                <div
                    class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <dl class=" text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                        <div class="flex flex-col pb-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400 text-center">Nama Pasien</dt>
                            <dd class="text-lg font-semibold text-center"> {{ $appointment->user->name }}</dd>
                        </div>
                        <div class="flex flex-col py-3">
                            <dt class="mb-1 text-center text-gray-500 md:text-lg dark:text-gray-400">Tanggal Konsultasi
                            </dt>
                            <dd class="text-lg font-semibold">
                                <div class="flex items-center justify-center  p-4 rounded-lg">
                                    <div class="text-center">
                                        <!-- Bulan -->
                                        <div class="text-sm font-medium text-gray-600 dark:text-gray-300 uppercase">
                                            {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('F') }}
                                        </div>
                                        <!-- Tanggal -->
                                        <div class="text-3xl font-bold text-gray-900 dark:text-white">
                                            {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('d') }}
                                        </div>
                                        <!-- Tahun -->
                                        <div class="text-sm font-medium text-gray-600 dark:text-gray-300">
                                            {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('Y') }}
                                        </div>
                                        <!-- Waktu -->
                                        <div class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('H:i') }} WIB
                                        </div>
                                    </div>
                                </div>
                            </dd>
                        </div>

                        <div class="flex flex-col pt-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status Konsultasi</dt>
                            <dd class="text-lg font-semibold">{{ $appointment->status }}</dd>
                        </div>
                        <div class="flex flex-col pt-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Konsultasi Selesai</dt>
                            <dd class="text-lg font-semibold">
                                @if ($appointment->completed_at)
                                    {{ \Carbon\Carbon::parse($appointment->completed_at)->format('d F Y, H:i') }}
                                @else
                                    Belum Selesai
                                @endif
                            </dd>
                        </div>
                        <div class="flex flex-col pt-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Catatan Medis</dt>
                            <dd class="text-lg font-semibold">
                                @if ($appointment->medical_notes)
                                    {{ $appointment->medical_notes }}
                                @else
                                    Belum Ada Catatan Medis
                                @endif
                            </dd>
                        </div>
                        <div class="flex flex-col pt-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Resep</dt>
                            <dd class="text-lg font-semibold">
                                @if ($appointment->prescription)
                                    {{ $appointment->prescription }}
                                @else
                                    Belum Ada Resep
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
        </main>
    </div>
</x-dashboard.dashboard-layout>
