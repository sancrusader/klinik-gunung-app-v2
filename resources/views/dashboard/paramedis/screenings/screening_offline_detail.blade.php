<x-dashboard.dashboard-layout>
    <x-slot:title>Screenings Offline Details</x-slot:title>
    <x-detail.tab tab1="Information" tab2="Quisioner" />
    <div id="default-tab-content">
        <div class="md:flex">
            {{-- * Tab Profile --}}
            <x-detail.tab-content header="Patients Infomartion" id="patients" aria="patients-tab">
                <img class="w-20 h-20 rounded-full  mb-4"
                    src="{{ $screening->user && $screening->user->profile_photo_path ? asset('storage/' . $screening->user->profile_photo_path) : asset('storage/avatar/klinik_gunung_avatar.jpg') }}"
                    alt="{{ $screening->full_name }} avatar">

                <x-detail.content-text name="Name">
                    {{ ucwords($screening->full_name) }}
                </x-detail.content-text>


                <x-detail.content-text name="Age">
                    {{ $screening->age }}
                </x-detail.content-text>

                <x-detail.content-text name="Gender">
                    {{ ucwords($screening->gender) }}
                </x-detail.content-text>

                <x-detail.content-text name="Contact">
                    {{ $screening->contact_number }}
                </x-detail.content-text>

                <x-detail.content-text name="Planned Hiking Date">
                    {{ $screening->planned_hiking_date }}
                </x-detail.content-text>

                <x-detail.content-text name="Previous Hikes Count">
                    {{ $screening->previous_hikes_count }}
                </x-detail.content-text>

            </x-detail.tab-content>

            {{-- * /Tab Quishioner --}}
            <x-detail.tab-content class="hidden" header="Quisioner" id="dashboard" aria="dashboard-tab">
                {{ $screening->physical_health_q1 }}
            </x-detail.tab-content>

            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel"
                aria-labelledby="settings-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">Age <strong
                        class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>.
                    Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps
                    classes to control the content visibility and styling.</p>
            </div>

            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel"
                aria-labelledby="settings-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>.
                    Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps
                    classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel"
                aria-labelledby="contacts-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>.
                    Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps
                    classes to control the content visibility and styling.</p>
            </div>
        </div>
</x-dashboard.dashboard-layout>
