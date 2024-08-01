<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        // Ambil semua screening dengan status 'processed' yang belum mendapatkan sertifikat
        $screenings = Screening::where('status', 'processed')
            ->where('certificate_issued', false)
            ->paginate(10);

        return view('kasir.welcome', compact('screenings'));
    }

    public function issueCertificate(Request $request, $id)
    {
        $screening = Screening::findOrFail($id);

        if ($screening->status === 'processed') {
            // Proses untuk mengeluarkan sertifikat
            $screening->certificate_path = $this->generateCertificate($screening);
            $screening->certificate_issued = true;
            $screening->save();

            return redirect()->route('kasir.dashboard')->with('status', 'Sertifikat telah berhasil dikeluarkan.');
        }

        return redirect()->route('kasir.dashboard')->with('error', 'Pendaki belum diproses oleh paramedis.');
    }

    private function generateCertificate($screening)
    {
        // Logika untuk mengeluarkan sertifikat (menggunakan PDF)
        $data = [
            'full_name' => $screening->full_name,
            'date_of_birth' => $screening->date_of_birth,
            'mountain' => $screening->mountain,
            'citizenship' => $screening->citizenship,
            'country' => $screening->country,
            'address' => $screening->address,
            'phone' => $screening->phone,
            'email' => $screening->email,
            'date' => now()->format('Y-m-d')
        ];

        $pdf = \PDF::loadView('certificates.certificate', $data);

        $path = 'certificates/';
        $filename = 'certificate_' . $screening->id . '.pdf';

        if (!\Storage::exists($path)) {
            \Storage::makeDirectory($path);
        }

        \Storage::put($path . $filename, $pdf->output());

        return $path . $filename;
    }
}
