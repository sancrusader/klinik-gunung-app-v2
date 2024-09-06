<?php

namespace App\Http\Controllers;

use App\Models\EmergencyCall;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmergencyCallController extends Controller
{
    public function create()
    {
        $coordinators = User::where('role', 'koordinator')->get();
        return view('emergency_calls.create', compact('coordinators'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'coordinator_id' => 'required|exists:users,id',
        ]);

        EmergencyCall::create([
            'patient_id' => Auth::id(),
            'coordinator_id' => $request->coordinator_id,
            'status' => 'pending',
        ]);

        return redirect()->route('emergency_calls.create')->with('success', 'An emergency call has been sent to the coordinator.');
    }

    public function index()
    {
        $calls = EmergencyCall::where('coordinator_id', Auth::id())->where('status', 'pending')->get();
        return view('emergency_calls.index', compact('calls'));
    }

    public function updateStatus($id, $status)
    {
        $call = EmergencyCall::findOrFail($id);
        $call->status = $status;
        $call->save();

        return redirect()->route('emergency_calls.index')->with('success', 'Status panggilan darurat telah diperbarui.');
    }

    // Menampilkan panggilan darurat
    public function show()
    {
        $calls = EmergencyCall::with(['patient', 'coordinator'])->get();
        return view('emergency_calls.show', compact('calls'));
    }

}
