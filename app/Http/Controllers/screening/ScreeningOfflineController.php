<?php

namespace App\Http\Controllers\screening;

use App\Http\Controllers\Controller;
use App\Models\ScreeningOffline;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;

class ScreeningOfflineController extends Controller
{
    // Menampilkan form pendaftaran screening
    public function create()
    {
        return view('screening_offlines.create');
    }

    // Menyimpan data screening baru
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
        ]);

        // Get the last queue number and increment it
        $lastQueueNumber = ScreeningOffline::max('queue_number');
        $queueNumber = $lastQueueNumber ? $lastQueueNumber + 1 : 1;

        ScreeningOffline::create([
            'queue_number' => $queueNumber,
            'full_name' => $request->full_name,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('screeningOffline.show')->with('success', 'Pendaftaran berhasil, nomor antrian: ' . $queueNumber);
    }

    // Menampilkan daftar screening yang belum diperiksa oleh paramedis
    public function index()
    {
        $screenings = ScreeningOffline::whereNull('health_check_result')->get();
        return view('screening_offlines.index', compact('screenings'));
    }

    // Menampilkan form pemeriksaan kesehatan
    public function checkHealth($id)
    {
        $screening = ScreeningOffline::findOrFail($id);
        return view('screening_offlines.check_health', compact('screening'));
    }

    // Mengupdate hasil pemeriksaan kesehatan
    public function updateHealthCheck(Request $request, $id)
    {
        $request->validate([
            'health_check_result' => 'required|string|in:sehat,tidak sehat',
        ]);

        $screening = ScreeningOffline::findOrFail($id);
        $screening->update([
            'health_check_result' => $request->health_check_result,
        ]);

        return redirect()->route('screening_offlines.payment', $screening->id);
    }

    // Menampilkan form pembayaran
    public function payment($id)
    {
        $screening = ScreeningOffline::findOrFail($id);
        return view('screening_offlines.payment', compact('screening'));
    }

    // Memproses pembayaran
    public function processPayment(Request $request, $id)
    {
        $screening = ScreeningOffline::findOrFail($id);
        $screening->update([
            'payment_status' => true,
        ]);

        if ($screening->health_check_result === 'sehat') {
            $certificatePath = $this->generateCertificate($screening);
            $screening->update([
                'certificate_path' => $certificatePath,
            ]);
        }

        return redirect()->route('screening_offlines.index')->with('success', 'Pembayaran berhasil dan sertifikat telah dibuat.');
    }

    private function generateCertificate($screening)
    {
        $data = [
            'full_name' => $screening->full_name,
            'health_check_result' => $screening->health_check_result,
        ];

        $pdf = PDF::loadView('certificates.simple_certificate', $data);

        $path = 'certificates/';
        $filename = 'certificate_' . $screening->id . '.pdf';

        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }

        Storage::put($path . $filename, $pdf->output());

        return $path . $filename;
    }

    public function show()
    {
        $userId = auth()->id();
        $screenings = ScreeningOffline::where('user_id', $userId)->get();
        return view('dashboard.pasien.screening.history_screening_offline', compact('screenings'));
    }

    public function edit($id)
    {
        $screening = ScreeningOffline::findOrFail($id);
        return view('dashboard.paramedis.screenings.screening_edit', compact('screening'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'health_check_result' => 'required|string',
        ]);

        $screening = ScreeningOffline::findOrFail($id);
        $screening->health_check_result = $request->health_check_result;
        $screening->save();

        return redirect()->route('paramedis.ScreeningHistory')->with('success', 'Hasil screening berhasil diperbarui.');
    }



}
