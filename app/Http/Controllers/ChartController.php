<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ScreeningOffline;

class ChartController extends Controller
{
    public function index()
    {
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
            $percentageChange = 100; // Jika minggu lalu tidak ada pembayaran, anggap 100% kenaikan
        }

        return view('dashboard.manajer.welcome', compact('dates', 'totals', 'totalPaymentsThisWeek', 'totalPaymentsLastWeek', 'percentageChange'));
    }




}
