<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create($queue_id)
    {
        $queue = Queue::findOrFail($queue_id);
        return view('payments.create', compact('queue'));
    }

    public function store(Request $request, $queue_id)
    {
        $queue = Queue::findOrFail($queue_id);

        $payment = Payment::create([
            'queue_id' => $queue_id,
            'status' => true,
        ]);

        return redirect()->route('queues.index')->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }
}
