<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Scan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\StaffSchedule;
use Illuminate\Support\Carbon;
use App\Models\ScreeningOffline;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        return redirect()->route('paramedis.dashboard')->with('status', 'Data scan QR berhasil disimpan.');
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

    public function showRegisterManualForm()
    {
        return view('dashboard.admin.register_patients_manual');
    }

    // Memproses pendaftaran manual
    public function registerPatientsManual(Request $request)
    {
        $patients = $request->input('patients');

        foreach ($patients as $index => $patient) {
            // Validasi data pasien
            $validator = Validator::make($patient, [
                'full_name' => 'required|string|max:255',
                // 'address' => 'required|string|max:255',
                // Tambahkan validasi lain sesuai kebutuhan
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Terdapat kesalahan dalam data pasien ke-' . ($index + 1));
            }

            // Menyimpan data pasien ke database
            ScreeningOffline::create([
                'queue_number' => ScreeningOffline::max('queue_number') + 1,
                'full_name' => $patient['full_name'],
                // 'address' => $patient['address'],
                // Tambahkan input lain sesuai kebutuhan
            ]);
        }

        return redirect()->route('admin.register-patients-manual')->with('success', 'Pendaftaran pasien berhasil dilakukan.');
    }
}

