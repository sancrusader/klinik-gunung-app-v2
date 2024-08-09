<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class KoordinatorPenyelamatController extends Controller
{
    public function index()
    {
        return view("dashboard.koordinator_penyelamat.welcome");
    }

    public function ManajemenDarurat()
    {
        return view("dashboard.koordinator_penyelamat.manajemen_darurat.index");
    }

    public function report()
    {
        return view("dashboard.koordinator_penyelamat.report.index");
    }
}
