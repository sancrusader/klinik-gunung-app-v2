<x-dashboard.dashboard-layout>

    <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
        <div class="px-4 pt-6">
            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Klinik Gunung</h5>
                <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Selamat datang
                    {{ Auth::user()->name }}
                </p>
            </div>

</x-dashboard.dashboard-layout>
