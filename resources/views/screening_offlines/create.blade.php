<x-layout>
    <x-slot:title>Screening Offline</x-slot:title>
    <x-toast />
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Screening
                Offline
            </h2>
            <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Mount Semeru
                Climbers Health and Readiness Questionnaire
            </p>
            <form action="{{ route('screening-offline.store') }}" class="max-w-md mx-auto" method="POST">
                @csrf
                <div class="relative z-0 w-full mb-5 group">
                    <x-form.input-screening type="text" name="full_name" id="full_name" placeholder=" "
                        for="full_name">Full
                        Name
                    </x-form.input-screening>
                    <br>
                    <div class="relative z-0 w-full mb-5 group">
                        <x-form.input-screening type="number" name="age" id="age" placeholder=" "
                            for="age">Age
                        </x-form.input-screening>
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <select name="gender" id=""
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer mb-5">
                            <option value="" selected disabled>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>

                        <div class="relative z-0 w-full mb-5 group">
                            <x-form.input-screening type="tel" name="contact_number" id="contact_number"
                                placeholder=" " for="contact_number">Contact Number
                            </x-form.input-screening>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <x-form.input-screening type="date" name="planned_hiking_date" id="planned_hiking_date"
                                placeholder=" " for="planned_hiking_date">Planed Hiking Date
                            </x-form.input-screening>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <x-form.input-screening type="number" name="previous_hikes_count" id="previous_hikes_count"
                                placeholder=" " for="previous_hikes_count">Previous Hikers Count (above 2,000 meters)
                            </x-form.input-screening>
                        </div>
                    </div>
                    {{-- Button --}}
                    <x-form.button-primary type="submit" class="w-full sm:w-full">
                        Submit
                    </x-form.button-primary>
            </form>
        </div>
    </section>

</x-layout>
