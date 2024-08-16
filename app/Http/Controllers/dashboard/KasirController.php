<?php

namespace App\Http\Controllers\dashboard;

use App\Mail\QrCodeMail;

use App\Models\Screening;
use Illuminate\Http\Request;
use App\Models\StaffSchedule;
use Illuminate\Support\Carbon;
use App\Models\ScreeningOffline;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KasirController extends Controller
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

        return view('dashboard.kasir.welcome', compact('dates', 'totals', 'totalPaymentsThisWeek', 'percentageChange'));
    }
    public function dashboard()
    {
        $screenings = ScreeningOffline::where('payment_status', false)
            ->where('payment_confirmed', false)
            ->paginate(10);

        return view('dashboard.kasir.offline', compact('screenings'));
    }

    public function shifKasir()
    {
        $kasirId = auth()->id(); // ID dokter yang sedang login

        // Ambil jadwal untuk dokter
        $schedules = StaffSchedule::where('staff_id', $kasirId)
            ->whereDate('schedule_date', '>=', Carbon::today())
            ->orderBy('schedule_date')
            ->get();

        return view('dashboard.kasir.shif.shif', compact('schedules'));
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

            return redirect()->route('kasir.welcome')->with('success', 'Pembayaran dikonfirmasi dan QR code telah dikirim.');
        }

        return redirect()->route('kasir.welcome')->with('error', 'Pembayaran belum dilakukan atau QR code sudah dikirim.');
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

    public function confirmPaymentOffline(Request $request, $id)
    {
        $screening = ScreeningOffline::findOrFail($id);
        $screening->payment_status = true;
        $screening->amount_paid = $request->amount_paid;
        $screening->save();

        $certificatePath = $this->generateCertificateOffline($screening);
        $screening->certificate_path = $certificatePath;
        $screening->save();

        return redirect()->route('kasir.welcome')->with('success', 'Pembayaran berhasil dikonfirmasi dan sertifikat telah dibuat.');
    }



    private function generateCertificateOffline($screening)
    {
        $data = [
            'full_name' => $screening->full_name,
            'health_check_result' => $screening->health_check_result,
            'date' => now()->format('Y-m-d')
        ];

        $pdf = PDF::loadView('certificates.simple_certificate', $data);

        $path = 'public/certificates/';
        $filename = 'certificate_' . $screening->id . '.pdf';

        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }

        Storage::put($path . $filename, $pdf->output());

        return $path . $filename;
    }

    // History Transaksi

    public function paymentHistory()
    {
        // Mendapatkan semua transaksi yang sudah dibayar
        $paidScreenings = ScreeningOffline::where('payment_status', true)->get();

        // Menyertakan URL sertifikat dalam setiap screening
        foreach ($paidScreenings as $screening) {
            $screening->certificate_url = Storage::url($screening->certificate_path);
        }

        return view('dashboard.kasir.payment.payment_history', compact('paidScreenings'));
    }



}
