<?php

namespace App\Http\Controllers\screening;

use App\Http\Controllers\Controller;

use App\Models\Queue;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index()
    {
        $queues = Queue::where('status', 'pending')->paginate(10);
        return view('queues.index', compact('queues'));
    }

    public function confirmPayment($id)
    {
        $queue = Queue::findOrFail($id);

        if ($queue->status === 'pending') {
            return redirect()->route('payments.create', $queue->id);
        }

        return redirect()->route('queues.index')->with('error', 'Pembayaran sudah dikonfirmasi.');
    }
}
