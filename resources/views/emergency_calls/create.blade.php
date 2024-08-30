<x-dashboard.dashboard-layout>
    <h1>Buat Panggilan Darurat</h1>

    <x-alert />
    <form action="{{ route('emergency_calls.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="coordinator_id">Pilih Koordinator</label>
            <select name="coordinator_id" id="coordinator_id" class="form-control">
                @foreach ($coordinators as $coordinator)
                    <option value="{{ $coordinator->id }}">{{ $coordinator->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-danger">Panggil Darurat</button>
    </form>
</x-dashboard.dashboard-layout>
