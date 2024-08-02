<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function showPendaki()
    {
        $users = User::where('role', 'pendaki')->get();
        return view('dashboard.admin.users.pendaki', compact('users'));
    }

    public function showAdmin()
    {
        $users = User::where('role', 'admin')->get();
        return view('dashboard.admin.users.admin', compact('users'));
    }

    public function showKasir()
    {
        $users = User::where('role', 'kasir')->get();
        return view('dashboard.admin.users.kasir', compact('users'));
    }


    public function showDokter()
    {
        $users = User::where('role', 'dokter')->get();
        return view('dashboard.admin.users.dokter', compact('users'));
    }
    public function showParamedis()
    {
        $users = User::where('role', 'paramedis')->get();
        return view('dashboard.admin.users.paramedis', compact('users'));
    }
    public function showManajer()
    {
        $users = User::where('role', 'manajer')->get();
        return view('dashboard.admin.users.manajer', compact('users'));
    }
    public function showkoordinatorPenyelamat()
    {
        $users = User::where('role', 'koordinatorPenyelamat')->get();
        return view('dashboard.admin.users.koordinator', compact('users'));
    }
}
