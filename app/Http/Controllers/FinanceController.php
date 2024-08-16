<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ScreeningOffline;

class FinanceController extends Controller
{
    public function index()
    {
        // Mendapatkan semua screening yang sudah dibayar
        $paidScreenings = ScreeningOffline::where('payment_status', true)->get();

        // Menghitung total pendapatan
        $totalRevenue = $paidScreenings->sum('amount_paid');

        // Menghitung jumlah pasien yang telah membayar
        $totalPaidPatients = $paidScreenings->count();

        // Mempersiapkan data untuk ditampilkan di view
        return view('finance.index', compact('paidScreenings', 'totalRevenue', 'totalPaidPatients'));
    }


}
