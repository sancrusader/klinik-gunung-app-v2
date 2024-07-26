<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Screening;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\QrCodeMail;

class ScreeningController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $screenings = Screening::where('user_id', $userId)->paginate(10);

        // Kirim data ke view
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

        // Create screening record
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
            'queue_number' => $this->generateQueueNumber(), // Implementasikan metode untuk menghasilkan nomor antrian
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

        // Update payment status
        $screening->payment_status = 'paid';
        $screening->save();

        // Generate QR code data
        $qrCodeData = json_encode([
            'full_name' => $screening->full_name,
            'date_of_birth' => $screening->date_of_birth,
            'mountain' => $screening->mountain,
            'citizenship' => $screening->citizenship,
            'country' => $screening->country,
            'address' => $screening->address,
            'phone' => $screening->phone,
            'email' => $screening->email,
            'question1' => $screening->question1,
            'question2' => $screening->question2,
            'question3' => $screening->question3,
            'additional_notes' => $screening->additional_notes,
            'status' => $screening->status,
            'queue_number' => $screening->queue_number,
        ]);

        // Generate QR code image
        $qrCodeImage = QrCode::format('png')->size(200)->generate($qrCodeData);

        // Define path to save QR code
        $path = storage_path('app/public/qrcodes/');
        $filename = 'qrcode_' . $screening->id . '.png';

        // Ensure the directory exists
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        // Save QR code image to file
        file_put_contents($path . $filename, $qrCodeImage);

        // Get URL for the QR code image
        $qrCodeUrl = asset('storage/qrcodes/' . $filename);

        // Update screening record with QR code URL
        $screening->qr_code_url = $qrCodeUrl;
        $screening->save();

        // Send QR code via email
        Mail::to($screening->email)->send(new QrCodeMail($screening, $qrCodeUrl));

        return redirect()->route('screenings.index')->with('success', 'Pembayaran berhasil, QR code telah dikirim.');
    }

    private function generateQueueNumber()
    {
        return Screening::max('queue_number') + 1;
    }
}
