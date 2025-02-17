<?php

namespace App\Http\Controllers\screening;


use App\Http\Controllers\Controller;
use App\Models\Screening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\QrCodeMail;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ScreeningController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $screenings = Screening::where('user_id', $userId)->paginate(10);
        return view('screenings.index', compact('screenings'));
    }

    public function create()
    {
        return view('screenings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'mountain' => 'required|string|max:255',
            'citizenship' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'question1' => 'required|boolean',
            'question2' => 'required|boolean',
            'question3' => 'required|boolean',
            'additional_notes' => 'nullable|string',
        ]);

        $screening = Screening::create([
            'user_id' => Auth::id(),
            'full_name' => $request->full_name,
            'date_of_birth' => $request->date_of_birth,
            'mountain' => $request->mountain,
            'citizenship' => $request->citizenship,
            'country' => $request->country,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'question1' => $request->question1,
            'question2' => $request->question2,
            'question3' => $request->question3,
            'additional_notes' => $request->additional_notes,
            'status' => 'pending',
            'queue_number' => $this->generateQueueNumber(),
        ]);

        return redirect()->route('screenings.payment', $screening->id);
    }

    public function payment($id)
    {
        $screening = Screening::findOrFail($id);
        return view('screenings.payment', compact('screening'));
    }

    public function paymentCallback(Request $request)
    {
        $screeningId = $request->input('screening_id');
        $screening = Screening::findOrFail($screeningId);

        $screening->payment_status = true;
        $screening->save();

        $qrCodeData = json_encode($screening->toArray());

        $qrCodeImage = QrCode::format('png')->size(200)->generate($qrCodeData);

        $path = storage_path('app/public/qrcodes/');
        $filename = 'qrcode_' . $screening->id . '.png';

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        file_put_contents($path . $filename, $qrCodeImage);

        $qrCodeUrl = asset('storage/qrcodes/' . $filename);

        $screening->qr_code_url = $qrCodeUrl;
        $screening->save();

        Mail::to($screening->email)->send(new QrCodeMail($screening, $qrCodeUrl));

        return redirect()->route('screenings.index')->with('success', 'Pembayaran berhasil, QR code telah dikirim.');
    }

    public function confirmPayment($id)
    {
        $screening = Screening::findOrFail($id);

        if ($screening->payment_status) {
            $screening->payment_confirmed = true;
            $screening->save();

            $certificatePath = $this->generateCertificate($screening);

            $screening->certificate_path = $certificatePath;
            $screening->certificate_issued = true;
            $screening->save();

            return redirect()->route('kasir.index')->with('success', 'Pembayaran berhasil dikonfirmasi dan sertifikat telah dibuat.');
        }

        return redirect()->route('kasir.index')->with('error', 'Pembayaran belum dilakukan.');
    }

    public function kasirScreeningPayment()
    {
        $screenings = Screening::where('payment_status', true)
            ->where('payment_confirmed', false)
            ->paginate(10);

        return view('dashboard.kasir.screening_online.confirm_payment_screening', compact('screenings'));
    }

    private function generateQueueNumber()
    {
        return Screening::max('queue_number') + 1;
    }

    private function generateCertificate($screening)
    {
        $data = [
            'full_name' => $screening->full_name,
            'date_of_birth' => $screening->date_of_birth,
            'mountain' => $screening->mountain,
            'citizenship' => $screening->citizenship,
            'country' => $screening->country,
            'address' => $screening->address,
            'phone' => $screening->phone,
            'email' => $screening->email,
            'date' => now()->format('Y-m-d')
        ];

        $pdf = PDF::loadView('certificates.certificate', $data);

        $path = 'certificates/';
        $filename = 'certificate_' . $screening->id . '.pdf';

        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }

        Storage::put($path . $filename, $pdf->output());

        return $path . $filename;
    }
}
