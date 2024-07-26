<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Notifications\EmailVerifiedNotification;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $role = $request->role ?? 'pendaki';
        if (!in_array($role, ['pendaki'])) {
            return redirect()->back()->withErrors(['role' => 'Invalid role.']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'queue_number' => User::max('queue_number') + 1,
        ]);

        Log::info('User created: ', ['user' => $user]);

        try {
            $user->sendEmailVerificationNotification();
            Log::info('Verification email sent to: ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Failed to send verification email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Please check your email to verify your account.');
    }


    // Verifikasi Email
    public function verifyEmail()
    {
        return view('auth.verify-email');
    }

    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect('/')->withErrors(['message' => 'Tautan verifikasi tidak valid']);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/pendaki/welcome')->with('status', 'Email Anda sudah terverifikasi.');
        }

        // if ($user->markEmailAsVerified()) {
        //     event(new Verified($user));

        //     // Kirim notifikasi ke admin
        //     $adminUsers = User::where('role', 'admin')->get();
        //     foreach ($adminUsers as $admin) {
        //         $admin->notify(new EmailVerifiedNotification($user));
        //     }
        // }


        return redirect('/verify-email')->with('status', 'Email Anda telah terverifikasi!');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'Tautan verifikasi telah dikirim!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on user role
            $role = Auth::user()->role;
            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.welcome');
                case 'dokter':
                    return redirect()->route('dokter.welcome');
                case 'kasir':
                    return redirect()->route('kasir.welcome');
                case 'koordinator':
                    return redirect()->route('koordinator.welcome');
                case 'manajer':
                    return redirect()->route('manajer.welcome');
                case 'paramedis':
                    return redirect()->route('paramedis.welcome');
                case 'pendaki':
                    return redirect()->route('pendaki.welcome');
                default:
                    return redirect()->route('home');
            }
        }

        // return back()->with('success', 'Please check your email to verify your account.');

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
