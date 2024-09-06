<x-dashboard.dashboard-layout>
    <x-slot:title>Screening Online</x-slot:title>
    <x-card.card>
        <x-stepper />
        <div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-3">
            <div
                class="items-center justify-center p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <form class="max-w-md mx-auto" action="{{ route('screenings.store') }}" method="POST">
                    @csrf
                    {{-- Input Full Name --}}
                    <div class="relative z-0 w-full mb-5 group">
                        <x-form.input-screening type="text" name="full_name" id="full_name" placeholder=" "
                            for="full_name">Full
                            Name
                        </x-form.input-screening>
                    </div>
                    {{-- Tanggal Lahir --}}
                    <div class="relative z-0 w-full mb-5 group">
                        <x-form.input-screening type="date" name="date_of_birth" id="date_of_birth" placeholder=" "
                            for="date_of_birth">
                            Date Of Birth
                        </x-form.input-screening>
                    </div>
                    {{-- Gunung --}}
                    <div class="relative z-0 w-full mb-5 group">
                        <x-form.input-screening type="text" name="mountain" id="mountain" placeholder=" "
                            for="mountain">
                            Mountain
                        </x-form.input-screening>
                    </div>
                    {{-- Citizenship --}}
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-5 group">
                            <x-form.input-screening name="citizenship" id="citizenship" for="citizenship"
                                placeholder=" ">
                                Citizenship
                            </x-form.input-screening>
                        </div>
                        {{-- Negera --}}
                        <div class="relative z-0 w-full mb-5 group">
                            <x-form.input-select-country name="country" id="country" for="country" />
                        </div>
                    </div>
                    {{-- Alamat --}}
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-5 group">
                            <x-form.input-screening name="address" id="address" for="address" placeholder=" ">
                                Address
                            </x-form.input-screening>
                        </div>
                        {{-- Nomor Telepon --}}
                        <div class="relative z-0 w-full mb-5 group">
                            <x-form.input-screening type="tel" name="phone" id="phone" for="phone"
                                placeholder=" ">
                                Phone Number
                            </x-form.input-screening>
                        </div>
                        {{-- Email --}}
                        <div class="relative z-0 w-full mb-5 group">
                            <x-form.input-screening type="email" name="email" id="email" for="email"
                                placeholder=" ">
                                Email
                            </x-form.input-screening>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-4">
                        Submit
                    </button>
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Next
                    </button>
                </form>
            </div>
        </div>
    </x-card.card>
</x-dashboard.dashboard-layout>
