<?php

namespace App\Http\Controllers;

use App\Models\Scan;
use Illuminate\Http\Request;
use App\Models\HealthCheck;

class ParamedisController extends Controller
{

    public function index()
    {
        return view('paramedis.welcome');
    }
    public function dashboard()
    {
        // Ambil semua scan dengan status 'pending'
        $scans = Scan::where('status', 'pending')->get();

        return view('paramedis.data', compact('scans'));
    }

    public function processHealthCheck(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'mountain' => 'required|string',
            'citizenship' => 'required|string',
            'country' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'question_1' => 'required|boolean',
            'question_2' => 'required|boolean',
        ]);

        $scan = Scan::findOrFail($id);
        $scan->update(['status' => 'processed']); // Update status scan

        $healthCheck = HealthCheck::create(array_merge($request->all(), ['scan_id' => $id]));

        return redirect()->route('kasir.dashboard')->with('status', 'Formulir cek kesehatan berhasil diproses.');
    }
}
