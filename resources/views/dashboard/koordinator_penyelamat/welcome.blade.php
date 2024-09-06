<x-dashboard.dashboard-layout>
    {{-- Title --}}
    <x-slot:title>Coordinator Dashboard</x-slot:title>
    <x-card.card>
        <x-card.card-auth />
        <div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-3">
            <x-card.card-profile />
        </div>
    </x-card.card>
</x-dashboard.dashboard-layout>
