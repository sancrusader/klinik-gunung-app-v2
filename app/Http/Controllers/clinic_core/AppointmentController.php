<?php

namespace App\Http\Controllers\clinic_core;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\AppointmentNotification;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('user', 'doctor')->get();
        $doctors = User::where('role', 'dokter')->get();

        return view('dashboard.pasien.appointments.index', compact('appointments', 'doctors'));
    }

    public function searchPasien(Request $request)
    {
        $search = $request->search;
        $doctors = User::where('role', 'dokter')->get();
        $appointments = Appointment::whereHas('user', function ($query) use ($search) {
            $query->where("name", "like", "%$search%");
        })
            ->get();

        return view('dashboard.pasien.appointments.index', compact('appointments', 'search', 'doctors'));
    }

    public function create()
    {
        $doctors = User::where('role', 'dokter')->get();
        return view('appointments.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'scheduled_at' => 'nullable|date',
            'unscheduled_reason' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        // Menyimpan data appointment
        $appointment = Appointment::create([
            'user_id' => $request->user_id,
            'doctor_id' => $request->doctor_id,
            'scheduled_at' => $request->scheduled_at,
            'unscheduled_reason' => $request->unscheduled_reason,
            'status' => $request->status,
        ]);


        $doctors = User::where('role', 'dokter')->get();

        foreach ($doctors as $doctor) {
            $doctor->notify(new AppointmentNotification($appointment));
        }


        return redirect()->route('pasien.appointments.index')->with('success', 'Appointment created successfully.');
    }

    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $doctors = User::where('role', 'dokter')->get();
        return view('appointments.edit', compact('appointment', 'doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'scheduled_at' => 'nullable|date',
            'unscheduled_reason' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        dd($request->all());

        $appointment->update($request->all());

        return redirect()->route('pasien.appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('pasien.appointments.index')->with('success', 'Appointment deleted successfully.');
    }

    public function accept($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'confirmed']);

        return redirect()->route('dokter.appointments.index')->with('success', 'Appointment accepted successfully.');
    }

    public function complete(Request $request, Appointment $appointment)
    {
        $appointment->update(['status' => 'completed', 'completed_at' => now()]);

        return redirect()->route('dokter.appointments.index')->with('success', 'Appointment completed successfully.');
    }

    public function doctorIndex()
    {
        $appointments = Appointment::where('doctor_id', auth()->id())->get();
        return view('dashboard.dokter.appointments.appointments_index', compact('appointments'));
    }

    public function doctorShow(Appointment $appointment)
    {
        return view('dashboard.dokter.appointments.appointments_show', compact('appointment'));
    }
    public function search(Request $request)
    {
        $search = $request->search;

        $appointments = Appointment::whereHas('user', function ($query) use ($search) {
            $query->where("name", "like", "%$search%");
        })
            ->get();

        return view('dashboard.dokter.appointments.appointments_index', compact('appointments', 'search'));
    }
}
