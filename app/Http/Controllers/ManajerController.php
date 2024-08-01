<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\StaffSchedule;

class ManajerController extends Controller
{

    public function index()
    {
        return view("manajer.welcome");
    }
    public function showScheduleForm()
    {
        $staff = User::all(); // Ambil semua staf
        return view('manajer.schedule_form', compact('staff'));
    }

    public function storeSchedule(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:users,id',
            'shift' => 'required|string',
            'schedule_date' => 'required|date',
            'role' => 'required|string', // Role harus diisi
        ]);

        StaffSchedule::create([
            'staff_id' => $request->staff_id,
            'shift' => $request->shift,
            'schedule_date' => $request->schedule_date,
            'role' => $request->role,
        ]);

        return redirect()->route('manajer.schedule.form')->with('success', 'Shift telah berhasil diatur.');
    }

    public function generateReport(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:weekly,monthly',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $reportContent = $this->generateReportContent($request->type, $request->start_date, $request->end_date);

        Report::create([
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'content' => $reportContent,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('manajer.reports')->with('success', 'Laporan berhasil dibuat.');
    }

    private function generateReportContent($type, $startDate, $endDate)
    {
        // Logika untuk menghasilkan konten laporan berdasarkan jenis dan tanggal
        return "Laporan $type dari $startDate sampai $endDate.";
    }

    public function viewReports()
    {
        $reports = Report::all();
        return view('manajer.reports', compact('reports'));
    }
}
