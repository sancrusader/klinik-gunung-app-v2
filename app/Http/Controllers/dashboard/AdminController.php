<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Scan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\StaffSchedule;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {

        $users = User::all();
        return view('dashboard.admin.welcome', compact('users'));
    }

    public function createUser()
    {
        $users = User::all();
        return view('dashboard.admin.users.users', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:pasien,admin,kasir,paramedis,dokter,manajer,koordinatorPenyelamat',
        ]);

        // 
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User added successfully.');
    }

    public function scanQr(Request $request)
    {
        // Validasi input
        $request->validate([
            'qr_code_data' => 'required|string',
        ]);

        // Dekode data QR code
        $data = json_decode($request->qr_code_data, true);

        // Simpan data scan ke database dengan status "pending"
        Scan::create([
            'full_name' => $data['full_name'],
            'date_of_birth' => $data['date_of_birth'],
            'mountain' => $data['mountain'],
            'citizenship' => $data['citizenship'],
            'country' => $data['country'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'question1' => $data['question1'],
            'question2' => $data['question2'],
            'question3' => $data['question3'],
            'additional_notes' => $data['additional_notes'],
            'status' => 'pending',
            'queue_number' => $data['queue_number'],
        ]);

        // Arahkan ke dashboard paramedis
        return redirect()->route('dashboard.paramedis.dashboard')->with('status', 'Data scan QR berhasil disimpan.');
    }

    public function shifAdmin()
    {
        $dokterId = auth()->id(); // ID dokter yang sedang login

        // Ambil jadwal untuk dokter
        $schedules = StaffSchedule::where('staff_id', $dokterId)
            ->whereDate('schedule_date', '>=', Carbon::today())
            ->orderBy('schedule_date')
            ->get();

        return view('dashboard.admin.shif.shif', compact('schedules'));
    }

}
