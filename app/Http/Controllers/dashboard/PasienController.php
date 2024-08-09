<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function index()
    {
        return view('dashboard.pasien.welcome');
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
