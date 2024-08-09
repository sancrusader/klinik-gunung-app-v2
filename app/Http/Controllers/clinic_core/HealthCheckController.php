<?php

namespace App\Http\Controllers\clinic_core;

use App\Http\Controllers\Controller;
use App\Models\HealthCheck;
use App\Models\Scan;
use Illuminate\Http\Request;

class HealthCheckController extends Controller
{
    public function index()
    {
        // Menampilkan data antrian
        $scans = Scan::where('status', 'pending')->get();
        return view('dashboard.paramedis.queue', compact('scans'));
    }

    public function create($scanId)
    {
        // Menampilkan form health check
        $scan = Scan::findOrFail($scanId);
        return view('dashboard.paramedis.healthcheck', compact('scan'));
    }

    public function store(Request $request, $scanId)
    {
        // Validasi input
        $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gunung' => 'required|string|max:255',
            'citizenship' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'question1' => 'required|boolean',
            'question2' => 'required|boolean',
            'question3' => 'required|boolean',
            'question4' => 'required|boolean',
            'question5' => 'required|boolean',
            'payment_status' => 'required|string|in:pending,paid',
        ]);

        // Simpan hasil health check
        HealthCheck::create([
            'scan_id' => $scanId,
            'full_name' => $request->full_name,
            'date_of_birth' => $request->date_of_birth,
            'gunung' => $request->gunung,
            'citizenship' => $request->citizenship,
            'country' => $request->country,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'question1' => $request->question1,
            'question2' => $request->question2,
            'question3' => $request->question3,
            'question4' => $request->question4,
            'question5' => $request->question5,
            'payment_status' => $request->payment_status,
        ]);

        // Update status scan menjadi processed
        $scan = Scan::findOrFail($scanId);
        $scan->status = 'processed';
        $scan->save();

        return redirect()->route('dashboard.paramedis.queue')->with('status', 'Health check berhasil disimpan.');
    }

    public function process(Request $request, $scanId)
    {
        // Arahkan ke form health check
        return redirect()->route('dashboard.paramedis.healthcheck.create', $scanId);
    }
}
