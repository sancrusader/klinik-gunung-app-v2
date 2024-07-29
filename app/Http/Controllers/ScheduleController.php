<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('doctor')->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function availableSchedules()
    {
        // Mengambil jadwal yang tidak memiliki konsultasi
        $schedules = Schedule::whereDoesntHave('consultations')->get();
        return view('pendaki.consultasi.create_schedule', compact('schedules'));
    }
}
