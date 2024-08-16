<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Screening;
use Illuminate\Http\Request;
use App\Models\ScreeningOffline;
use Illuminate\Routing\Controller;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReportController extends Controller
{
    public function generatePDF()
    {
        $screeningOnlineDetails = Screening::all();
        $totalScreeningOnline = Screening::count();

        $totalScreeningOffline = ScreeningOffline::count();
        $totalUangMasuk = ScreeningOffline::sum('amount_paid');
        $screeningDetails = ScreeningOffline::all(); // Jika ingin menampilkan detail

        // Data yang akan dikirim ke view
        $data = [
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
