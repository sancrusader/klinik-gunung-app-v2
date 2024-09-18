@props(['tab1', 'tab2'])
<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
        data-tabs-toggle="#default-tab-content" role="tablist">
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="patients-tab" data-tabs-target="#patients"
                type="button" role="tab" aria-controls="patients"
                aria-selected="false">{{ $tab1 }}</button>
        </li>
        <li class="me-2" role="presentation">
            <button
                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                aria-selected="false">{{ $tab2 }}</button>
        </li>
        <li class="me-2" role="presentation">
            <button
                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings"
                aria-selected="false">Settings</button>
        </li>
        <li role="presentation">
            <button
                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts"
                aria-selected="false">Contacts</button>
        </li>
    </ul>

</div>
