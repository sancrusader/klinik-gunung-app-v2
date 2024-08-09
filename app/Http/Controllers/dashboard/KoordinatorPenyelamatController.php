<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\StaffSchedule;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class KoordinatorPenyelamatController extends Controller
{
    public function index()
    {
        return view("dashboard.koordinator_penyelamat.welcome");
    }

    public function ManajemenDarurat()
    {
        return view("dashboard.koordinator_penyelamat.manajemen_darurat.index");
    }

    public function report()
    {
        return view("dashboard.koordinator_penyelamat.report.index");
    }

    public function shifKoordinator()
    {
        $koordinatorId = auth()->id(); // ID dokter yang sedang login

        // Ambil jadwal untuk dokter
        $schedules = StaffSchedule::where('staff_id', $koordinatorId)
            ->whereDate('schedule_date', '>=', Carbon::today())
            ->orderBy('schedule_date')
            ->get();

        return view('dashboard.koordinator_penyelamat.shif.shif', compact('schedules'));
    }
}
