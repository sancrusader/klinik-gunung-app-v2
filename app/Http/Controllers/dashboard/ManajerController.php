<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\screening\ScreeningOfflineController;
use App\Models\User;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\StaffSchedule;
use Illuminate\Support\Carbon;
use App\Models\ScreeningOffline;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ManajerController extends Controller
{

    public function index()
    {

        $latestScreening = ScreeningOffline::orderBy('created_at', 'desc')->take(5)->get();

        // Ambil total pasien baru per hari selama 7 hari terakhir
        $patientsData = User::where('role', 'pasien') // Ambil berdasarkan peran pasien
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total_patients')
            ->where('created_at', '>=', Carbon::now()->subDays(1))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Siapkan data untuk chart
        $datesPasien = [];
        $totalsPasien = [];

        foreach ($patientsData as $data) {
            $datesPasien[] = Carbon::parse($data->date)->format('d F');
            $totalsPasien[] = $data->total_patients;
        }

        // Ambil total pendapatan minggu ini
        $paymentsData = ScreeningOffline::selectRaw('DATE(created_at) as date, SUM(amount_paid) as total_payment')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->where('payment_status', true) // Hanya mengambil data yang sudah dibayar
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Siapkan data untuk chart
        $dates = [];
        $totals = [];

        foreach ($paymentsData as $data) {
            $dates[] = Carbon::parse($data->date)->format('d F');
            $totals[] = $data->total_payment;
        }

        $totalPaymentsThisWeek = ScreeningOffline::where('payment_status', true)
            ->where('created_at', '>=', Carbon::now()->startOfWeek())
            ->sum('amount_paid');

        $totalPaymentsLastWeek = ScreeningOffline::where('payment_status', true)
            ->whereBetween('created_at', [
                Carbon::now()->subWeek()->startOfWeek(),
                Carbon::now()->subWeek()->endOfWeek()
            ])->sum('amount_paid');

        if ($totalPaymentsLastWeek > 0) {
            $percentageChange = (($totalPaymentsThisWeek - $totalPaymentsLastWeek) / $totalPaymentsLastWeek) * 100;
        } else {
            $percentageChange = 100;
        }

        $totalPatients = User::where('role', 'pasien')->count();

        return view('dashboard.manajer.welcome', compact('dates', 'totals', 'totalPaymentsThisWeek', 'totalPaymentsLastWeek', 'percentageChange', 'datesPasien', 'totalsPasien', 'totalPatients', 'latestScreening'));
    }

    public function showScheduleForm()
    {
        $staff = User::all(); // Ambil semua staf
        return view('dashboard.manajer.schedule_form', compact('staff'));
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

        return redirect()->route('dashboard.manajer.schedule.form')->with('success', 'Shift telah berhasil diatur.');
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

        return redirect()->route('dashboard.manajer.reports')->with('success', 'Laporan berhasil dibuat.');
    }

    private function generateReportContent($type, $startDate, $endDate)
    {
        // Logika untuk menghasilkan konten laporan berdasarkan jenis dan tanggal
        return "Laporan $type dari $startDate sampai $endDate.";
    }

    public function viewReports()
    {
        $reports = Report::all();
        return view('dashboard.manajer.reports', compact('reports'));
    }

    public function getNewUsers()
    {
        $newUsers = User::where('role', 'pasien')
            ->where('created_at', '>=', Carbon::now()->subMonth())
            ->count();

        return response()->json([
            'new_users' => $newUsers,
            'percentage_change' => $this->getPercentageChange()
        ]);
    }

    private function getPercentageChange()
    {
        $currentMonth = User::where('role', 'pasien')
            ->where('created_at', '>=', Carbon::now()->startOfMonth())
            ->count();

        $lastMonth = User::where('role', 'pasien')
            ->where('created_at', '>=', Carbon::now()->subMonth()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->startOfMonth())
            ->count();

        if ($lastMonth == 0) {
            return $currentMonth > 0 ? 100 : 0;
        }

        return (($currentMonth - $lastMonth) / $lastMonth) * 100;
    }

    // Activity
    public function ScreeningAcitivity()
    {
        // Mendapatkan semua transaksi yang sudah dibayar
        $screenings = ScreeningOffline::all();

        // Menyertakan URL sertifikat dalam setiap screening
        foreach ($screenings as $screening) {
            $screening->certificate_url = Storage::url($screening->certificate_path);
        }
        return view('dashboard.manajer.screening.screening_activity', compact('screenings'));
    }

}
