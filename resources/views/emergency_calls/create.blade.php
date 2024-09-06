<x-dashboard.dashboard-layout>
    <x-card.card>
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white mb-4">Emergency Respon</h1>
        <x-toast />
        <form action="{{ route('emergency_calls.store') }}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label for="coordinator" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                    Coordinator</label>
                <select id="coordinator" name="coordinator_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-27 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" @disabled(true) @selected(true)>
                        Select Coordinator
                    </option>
                    @foreach ($coordinators as $coordinator)
                        <option value="{{ $coordinator->id }}">{{ $coordinator->name }}</option>
                    @endforeach
                </select>
            </div>
            <x-form.button-primary type="submit">Submit</x-form.button-primary>
        </form>
    </x-card.card>
</x-dashboard.dashboard-layout>
