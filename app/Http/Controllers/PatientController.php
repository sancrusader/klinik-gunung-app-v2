<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        return view('pendaki.welcome');
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
