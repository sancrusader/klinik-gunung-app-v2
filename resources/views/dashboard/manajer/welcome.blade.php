<x-dashboard.dashboard-layout>
    <x-chartjs />
    <x-slot:title>Manajer Dashboard</x-slot:title>
    <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
        <main>
            <div class="px-4 pt-6">
                <div class="grid gap-4 xl:grid-cols-2 2xl:grid-cols-3">

                    <x-chart :dates="$dates" :totals="$totals" :totalPaymentsThisWeek="$totalPaymentsThisWeek" :totalPaymentsLastWeek="$totalPaymentsLastWeek"
                        :percentageChange="$percentageChange" />

                    <x-activity-klinik :latestScreening="$latestScreening">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            @if ($latestScreening->isEmpty())
                                <p>Tidak ada screening terbaru.</p>
                            @else
                                @foreach ($latestScreening as $screening)
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center min-w-0">
                                                <div class="ml-3">
                                                    <p class="font-medium text-gray-900 truncate dark:text-white">
                                                        {{ $screening->full_name }}
                                                    </p>
                                                    <div
                                                        class="flex items-center justify-end flex-1 text-sm text-green-500 dark:text-green-400">

                                                        <span
                                                            class="text-gray-500">{{ $screening->created_at->format('d F Y H:i') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            @endif
                        </ul>
                    </x-activity-klinik>

                </div>

                <div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-3">

                    <x-pasien-chart :datesPasien="$datesPasien" :totalsPasien="$totalsPasien"
                        :totalPatients="$totalPatients">{{ number_format($totalPatients) }}
                    </x-pasien-chart>

                    <x-total-screening />

                </div>

            </div>
        </main>
    </div>

</x-dashboard.dashboard-layout>
