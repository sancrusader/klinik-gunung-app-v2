<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class KtpController extends Controller
{
    public function scanKtp(Request $request)
    {

        // Validasi file gambar
        $request->validate([
            'ktp_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan file gambar yang diupload
        $imagePath = $request->file('ktp_image')->store('ktp_images');

        // Inisialisasi Google Cloud Vision
        $imageAnnotator = new ImageAnnotatorClient([
            'credentials' => storage_path('data.json')
        ]);
        // Baca isi file gambar
        $imageContent = Storage::get($imagePath);

        // Panggil API Google Vision untuk melakukan OCR
        $response = $imageAnnotator->textDetection($imageContent);
        $texts = $response->getTextAnnotations();

        // Ambil teks hasil OCR
        $ocrText = '';
        if ($texts) {
            $ocrText = $texts[0]->getDescription();
        }

        // Tutup koneksi API
        $imageAnnotator->close();

        // Tampilkan hasil OCR di view
        return view('ktp.scan_result', ['ocrText' => $ocrText]);
    }
}

//     public function scan(Request $request)
//     {
//         $request->validate([
//             'ktp_file' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
//             'ktp_image' => 'nullable|string',
//         ]);

//         if ($request->hasFile('ktp_file')) {
//             $file = $request->file('ktp_file');
//             $fileName = 'ktp_' . time() . '.' . $file->getClientOriginalExtension();
//             $path = $file->storeAs('public/ktp_images', $fileName);
//             $absolutePath = storage_path('app/public/ktp_images/' . $fileName);
//         } elseif ($request->filled('ktp_image')) {
//             $data = $request->input('ktp_image');

//             if (preg_match('/^data:image\/(png|jpg|jpeg);base64,/', $data, $matches)) {
//                 $data = str_replace($matches[0], '', $data);
//                 $imageData = base64_decode($data);

//                 if ($imageData === false) {
//                     return redirect()->back()->withErrors('Gambar tidak valid.');
//                 }

//                 $fileName = 'ktp_' . time() . '.png';
//                 $path = storage_path('app/public/ktp_images/' . $fileName);
//                 file_put_contents($path, $imageData);
//                 $absolutePath = $path;
//             } else {
//                 return redirect()->back()->withErrors('Format gambar tidak valid.');
//             }
//         } else {
//             return redirect()->back()->withErrors('No file or image provided.');
//         }

//         // Proses gambar dengan Tesseract OCR
//         if (!file_exists($absolutePath)) {
//             return redirect()->back()->withErrors('File gambar tidak ditemukan.');
//         }

//         $text = (new TesseractOCR($absolutePath))
//             ->run();

//         // Debugging: Tampilkan hasil OCR
//         dd($text);

//         // Ekstrak informasi dari teks yang diproses
//         $nikPattern = '/\b\d{16}\b/';
//         preg_match($nikPattern, $text, $nikMatches);
//         $nik = $nikMatches[0] ?? null;

//         // Proses ekstraksi nama dan alamat berdasarkan pola yang lebih umum
//         $namePattern = '/Nama\s*:\s*([^\r\n]*)/i';
//         preg_match($namePattern, $text, $nameMatches);
//         $name = $nameMatches[1] ?? null;

//         $addressPattern = '/Alamat\s*:\s*([^\r\n]*)/i';
//         preg_match($addressPattern, $text, $addressMatches);
//         $address = $addressMatches[1] ?? null;

//         // Simpan data ke database
//         KtpScan::create([
//             'name' => $name,
//             'nik' => $nik,
//             'address' => $address,
//             'image_path' => 'ktp_images/' . $fileName,
//         ]);

//         return redirect()->route('ktp.capture')->with('success', 'KTP berhasil diupload');
//     }
// }

