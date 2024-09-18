<x-dashboard-layout>
    <x-slot:title>Pasien Dashboard</x-slot:title>
    <x-card.card>
        <x-card.card-auth />
        <div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-3">
            <x-card.card-profile />
            <div
                class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Latest Screenings</h5>
                    <a href="{{ route('screeningOffline.show') }}"
                        class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                        View all
                    </a>
                </div>
                <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($screeningsOffline as $screening)
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->getProfilePhotoUrl() }}"
                                            alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ $screening->full_name }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{ $screening->created_at }}
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        @if ($screening->health_check_result == 0)
                                            N/A
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </x-card.card>
    <x-dashboard-footer />
</x-dashboard-layout>
