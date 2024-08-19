<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Screening;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ScreeningOffline;
use Illuminate\Routing\Controller;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReportController extends Controller
{
    public function index()
    {
        return view("dashboard.manajer.report.form");
    }
    public function generatePDF(Request $request)
    {
        // Ambil parameter periode (weekly atau monthly)
        $periode = $request->input('periode');

        // Inisialisasi variabel tanggal awal dan akhir
        $startDate = null;
        $endDate = null;

        if ($periode == 'weekly') {
            // Set tanggal awal dan akhir untuk laporan mingguan
            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();
        } elseif ($periode == 'monthly') {
            // Set tanggal awal dan akhir untuk laporan bulanan
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        }

        // Query data berdasarkan periode yang dipilih
        $screeningOnlineDetails = Screening::whereBetween('created_at', [$startDate, $endDate])->get();
        $totalScreeningOnline = Screening::whereBetween('created_at', [$startDate, $endDate])->count();

        $screeningDetails = ScreeningOffline::whereBetween('created_at', [$startDate, $endDate])->get();
        $totalScreeningOffline = $screeningDetails->count();
        $totalUangMasuk = $screeningDetails->sum('amount_paid');

        // Data yang akan dikirim ke view
        $data = [
            'periode' => $periode,
            'totalScreeningOnline' => $totalScreeningOnline,
            'screeningOnlineDetails' => $screeningOnlineDetails,
            'totalScreeningOffline' => $totalScreeningOffline,
            'totalUangMasuk' => $totalUangMasuk,
            'screeningDetails' => $screeningDetails,
        ];

        // Buat objek PDF menggunakan Dompdf
        $pdf = new Dompdf();
        $options = new Options();
        $options->set('defaultFont', 'Arial'); // Atur font default
        $pdf->setOptions($options);

        // Render view ke dalam PDF
        $pdf = PDF::loadView('report.pdf', $data);

        // Stream atau unduh PDF
        return $pdf->stream('report.pdf');
    }
}
