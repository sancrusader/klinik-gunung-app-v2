<x-dashboard.dashboard-layout>
    <x-card.card>
        <h1>Edit Medical Record for {{ $appointment->user->name }}</h1>
        <form action="{{ route('dokter.medical_records.update',$appointment->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="medical_notes">Medical Notes:</label>
                <textarea name="medical_notes" id="medical_notes">{{ old('medical_notes', $appointment->medical_notes) }}</textarea>
            </div>
            <div>
                <label for="prescription">Prescription:</label>
                <textarea name="prescription" id="prescription">{{ old('prescription', $appointment->prescription) }}</textarea>
            </div>
            <div>
                <label for="examination_photo">Examination Photo:</label>
                <input type="file" name="examination_photo" id="examination_photo">
            </div>
            @if ($appointment->examination_photo)
                <div>
                    <img src="{{ Storage::url($appointment->examination_photo) }}" alt="Examination Photo"
                        width="200">
                </divdadad>
            @endif

            <button type="submit">Save</button>
        </form>
    </x-card.card>
</x-dashboard.dashboard-layout>
