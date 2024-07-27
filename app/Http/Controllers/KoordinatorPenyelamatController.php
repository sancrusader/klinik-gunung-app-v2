<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KoordinatorPenyelamatController extends Controller
{
    public function index()
    {
        return view("koordinator_penyelamat.welcome");
    }
}
