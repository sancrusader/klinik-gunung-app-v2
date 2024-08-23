<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Menampilkan form kontak
    public function showForm()
    {
        return view('pages.contact');
    }

    // Menangani submit form kontak
    public function submitForm(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Mengirim email
        Mail::send('emails.contact', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'bodyMessage' => $request->input('message'),
        ], function ($mail) use ($request) {
            $mail->from($request->input('email'), $request->input('name'));
            $mail->to('your-email@example.com')->subject('Contact Us Message');
        });

        // Redirect dengan pesan sukses
        return redirect()->route('contact.form')->with('success', 'Pesan Anda telah berhasil dikirim!');
    }
}
