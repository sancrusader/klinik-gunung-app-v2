<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\StaffSchedule;

class DokterController extends Controller
{

    public function dashboard()
    {
        return view('dashboard.dokter.welcome');
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
