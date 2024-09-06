<?php

namespace App\Http\Controllers\dashboard;

use Carbon\Carbon;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\StaffSchedule;
use App\Http\Controllers\Controller;

class DokterController extends Controller
{

    public function dashboard()
    {

        $appointments = Appointment::where('doctor_id', auth()->id())->get();
        return view('dashboard.dokter.welcome', compact('appointments'));
    }
    public function shif()
    {
        $doctorId = auth()->id(); // ID dokter yang sedang login

        // Ambil jadwal untuk dokter
        $schedules = StaffSchedule::where('staff_id', $doctorId)
            ->whereDate('schedule_date', '>=', Carbon::today())
            ->orderBy('schedule_date')
            ->get();

        return view('dashboard.dokter.shif.shif', compact('schedules'));
    }
}
