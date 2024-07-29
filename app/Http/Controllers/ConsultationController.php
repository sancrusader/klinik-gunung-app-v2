<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function hikerIndex()
    {
        $consultations = Consultation::where('hiker_id', auth()->id())->get();
        $doctors = User::where('role', 'dokter')->get();
        $schedules = Schedule::whereDoesntHave('consultations')->get(); // Jadwal yang belum dipilih

        return view('pendaki.consultasi.index', compact('consultations', 'doctors', 'schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'question' => 'required|string|max:255',
        ]);

        Consultation::create([
            'hiker_id' => auth()->id(),
            'doctor_id' => $request->doctor_id,
            'schedule_id' => $request->schedule_id,
            'question' => $request->question,
        ]);

        return redirect()->route('pendaki.consultasi.index')->with('success', 'Konsultasi berhasil dijadwalkan.');
    }

    public function doctorIndex()
    {
        $consultations = Consultation::where('doctor_id', auth()->id())->get();
        return view('dokter.consultasi.index', compact('consultations'));
    }

    public function complete(Consultation $consultation)
    {
        $consultation->update([
            'status' => 'completed'
        ]);

        return redirect()->route('dokter.consultasi.index')->with('success', 'Konsultasi berhasil diselesaikan.');
    }
}

