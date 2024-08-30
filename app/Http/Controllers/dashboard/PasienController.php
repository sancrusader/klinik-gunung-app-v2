<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;

use App\Models\ScreeningOffline;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function index()
    {
        // Menampilkan Screening Pasien
        $screeningsOffline = ScreeningOffline::whereNull('health_check_result')->get()->take(4);
        return view('dashboard.pasien.welcome', compact('screeningsOffline'));
    }

    public function screening()
    {
        return view('screenings.create');
    }

    public function AccountInformation()
    {
        return view('screenings.create');
    }
}
