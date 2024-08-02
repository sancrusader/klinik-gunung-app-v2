<?php

namespace App\Http\Controllers;

use App\Mail\QrCodeMail;
use App\Models\Screening;
use Illuminate\Http\Request;
use App\Models\ScreeningOffline;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KasirController extends Controller
{
    public function dashboard()
    {
        $screenings = ScreeningOffline::where('payment_status', false)
            ->where('payment_confirmed', false)
            ->paginate(10);

        return view('dashboard.kasir.offline', compact('screenings'));
    }
    public function confirmPayment(Request $request, $id)
    {
        $screening = Screening::findOrFail($id);

        if ($screening->payment_status && !$screening->qr_code_sent) {
            $screening->payment_confirmed = true;
            $screening->save();

            // Generate QR Code
            $qrCodeData = json_encode($screening->toArray());
            $qrCodeImage = QrCode::format('png')->size(200)->generate($qrCodeData);
            $path = storage_path('app/public/qrcodes/');
            $filename = 'qrcode_' . $screening->id . '.png';

            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            file_put_contents($path . $filename, $qrCodeImage);
            $qrCodeUrl = asset('storage/qrcodes/' . $filename);

            $screening->qr_code_url = $qrCodeUrl;
            $screening->qr_code_sent = true;
            $screening->save();

            // Send QR Code to Email
            Mail::to($screening->email)->send(new QrCodeMail($screening, $qrCodeUrl));

            return redirect()->route('dashboard.kasir.welcome')->with('success', 'Pembayaran dikonfirmasi dan QR code telah dikirim.');
        }

        return redirect()->route('dashboard.kasir.welcome')->with('error', 'Pembayaran belum dilakukan atau QR code sudah dikirim.');
    }

    public function index()
    {
        $screenings = Screening::where('payment_status', true)
            ->where('payment_confirmed', false)
            ->paginate(10);

        return view('dashboard.kasir.welcome', compact('screenings'));
    }
    public function issueCertificate(Request $request, $id)
    {
        $screening = Screening::findOrFail($id);

        if ($screening->status === 'processed') {
            // Proses untuk mengeluarkan sertifikat
            $screening->certificate_path = $this->generateCertificate($screening);
            $screening->certificate_issued = true;
            $screening->save();

            return redirect()->route('dashboard.kasir.dashboard')->with('status', 'Sertifikat telah berhasil dikeluarkan.');
        }

        return redirect()->route('dashboard.kasir.dashboard')->with('error', 'Pendaki belum diproses oleh paramedis.');
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

        $pdf = PDF::loadView('certificates.certificate', $data);

        $path = 'certificates/';
        $filename = 'certificate_' . $screening->id . '.pdf';

        if (!\Storage::exists($path)) {
            \Storage::makeDirectory($path);
        }

        \Storage::put($path . $filename, $pdf->output());

        return $path . $filename;
    }

    public function viewCertificates()
    {
        $screenings = Screening::whereNotNull('certificate_path')->paginate(10);

        return view('dashboard.kasir.certificates', compact('screenings'));
    }

    public function ScreeningOffline()
    {
        $screenings = ScreeningOffline::whereNotNull('health_check_result')
            ->where('payment_status', false)
            ->paginate(10);

        return view('dashboard.kasir.screening_offline', compact('screenings'));
    }

    public function confirmPaymentOffline($id)
    {
        $screening = ScreeningOffline::findOrFail($id);
        $screening->payment_status = true;
        $screening->save();

        $certificatePath = $this->generateCertificate($screening);
        $screening->certificate_path = $certificatePath;
        $screening->save();

        return redirect()->route('kasir.index')->with('success', 'Pembayaran berhasil dikonfirmasi dan sertifikat telah dibuat.');
    }


    private function generateCertificateOffline($screening)
    {
        $data = [
            'full_name' => $screening->full_name,
            'health_check_result' => $screening->health_check_result,
            'date' => now()->format('Y-m-d')
        ];

        $pdf = PDF::loadView('certificates.certificate', $data);

        $path = 'certificates/';
        $filename = 'certificate_' . $screening->id . '.pdf';

        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }

        Storage::put($path . $filename, $pdf->output());

        return $path . $filename;
    }


}
