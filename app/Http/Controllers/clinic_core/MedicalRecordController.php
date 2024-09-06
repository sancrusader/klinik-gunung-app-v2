<?php

// app/Http/Controllers/MedicalRecordController.php

namespace App\Http\Controllers\clinic_core;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicalRecordController extends Controller
{
    public function edit(Appointment $appointment)
    {
        return view('medical_records.edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'medical_notes' => 'nullable|string',
            'prescription' => 'nullable|string',
            'examination_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'follow_up_date' => 'nullable|date',
        ]);

        if ($request->hasFile('examination_photo')) {
            $filePath = $request->file('examination_photo')->store('examination_photos', 'public');
            if ($appointment->examination_photo) {
                Storage::disk('public')->delete($appointment->examination_photo);
            }
            $appointment->examination_photo = $filePath;
        }

        $appointment->medical_notes = $request->medical_notes;
        $appointment->prescription = $request->prescription;
        $appointment->follow_up_date = $request->follow_up_date;
        $appointment->status = 'completed'; // Mengubah status menjadi 'completed'
        $appointment->completed_at = now();

        $appointment->save();

        return redirect()->route('dokter.appointments.index')->with('success', 'Medical record updated and follow-up scheduled successfully.');
    }
}
