<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Scan;

use App\Models\Screening;
use App\Models\HealthCheck;
use Illuminate\Http\Request;
use App\Models\StaffSchedule;
use Illuminate\Support\Carbon;
use App\Models\ScreeningOffline;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;

class ParamedisController extends Controller
{
    public function index()
    {
        $scans = Scan::where('status', 'pending')->get();
        return view('dashboard.paramedis.welcome', compact('scans'));
    }

    public function dashboard()
    {
        // Ambil semua scan dengan status 'pending'
        $scans = Scan::where('status', 'pending')->get();

        return view('dashboard.paramedis.data', compact('scans'));
    }

    public function processHealthCheck(Request $request, $id)
    {
        \Log::info('Request Data:', $request->all());

        $request->validate([
            'health_status' => 'required|string|in:sehat,tidak sehat',
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'mountain' => 'required|string|max:255',
            'citizenship' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'question1' => 'required|boolean',
            'question2' => 'required|boolean',
            'question3' => 'required|boolean',
        ]);

        $scan = Scan::findOrFail($id);
        $scan->update(['status' => 'processed']); // Update status scan

        $data = array_merge($request->all(), ['scan_id' => $id]);
        \Log::info('Data to be inserted into health_checks:', $data);

        $healthCheck = HealthCheck::create($data);

        if ($request->health_status === 'sehat') {
            $screening = Screening::where('id', $scan->screening_id)->first();
            $certificatePath = $this->generateCertificate($screening);

            $screening->certificate_path = $certificatePath;
            $screening->certificate_issued = true;
            $screening->save();

            return redirect()->route('dashboard.paramedis.welcome')->with('status', 'Formulir cek kesehatan berhasil diproses dan sertifikat telah dibuat.');
        }

        return redirect()->route('dashboard.paramedis.welcome')->with('status', 'Formulir cek kesehatan berhasil diproses.');
    }


    private function generateCertificate($screening)
    {
        $data = [
            'full_name' => $screening->full_name,
            'date_of_birth' => $screening->date_of_birth,
            'mountain' => $screening->mountain,
            'citizenship' => $screening->citizenship,
            'country' => $screening->country,
            'address' => $screening->address,
            'phone' => $screening->phone,
            'email' => $screening->email,
            'date' => now()->format('Y-m-d'),
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

    public function ScreeningOffline()
    {
        $screenings = ScreeningOffline::whereNull('health_check_result')->paginate(10);
        return view('dashboard.paramedis.screening_offline', compact('screenings'));
    }

    // Memperbarui hasil cek kesehatan
    public function updateHealthCheck(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'health_check_result' => 'required|in:tidak_didampingi,butuh_pendamping,butuh_dokter',
        ]);

        // Temukan data screening offline berdasarkan ID
        $screening = ScreeningOffline::findOrFail($id);

        // Perbarui hasil cek kesehatan
        $screening->health_check_result = $request->health_check_result;
        $screening->save();

        // Redirect kembali ke halaman paramedis dengan pesan sukses
        return redirect()->route('paramedis.ScreeningOffline')->with('success', 'Hasil cek kesehatan berhasil diperbarui.');
    }

    // Shif Schedule
    public function shifParamedis()
    {
        $paramedisId = auth()->id(); // ID dokter yang sedang login

        // Ambil jadwal untuk dokter
        $schedules = StaffSchedule::where('staff_id', $paramedisId)
            ->whereDate('schedule_date', '>=', Carbon::today())
            ->orderBy('schedule_date')
            ->get();

        return view('dashboard.paramedis.shif.shif', compact('schedules'));
    }

}
