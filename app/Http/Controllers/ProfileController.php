<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

/** @var \App\Models\User $user **/

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'phone_number' => 'nullable|string|max:15',
            'birth_date' => 'nullable|date',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ];

        // Tambahkan aturan untuk nama dan email hanya jika mereka diubah
        if ($request->name !== $user->name) {
            $rules['name'] = 'required|string|max:255';
        }

        if ($request->email !== $user->email) {
            $rules['email'] = 'required|string|email|max:255|unique:users,email,' . $user->id;
        }

        $request->validate($rules);

        // Update profil
        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->phone_number = $request->phone_number ?? $user->phone_number;
        $user->birth_date = $request->birth_date ?? $user->birth_date;

        // Handle password update
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function showPasswordForm()
    {
        return view('profile.edit_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Password updated successfully.');
    }

    public function updatePhoto(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            // Hapus foto profil lama jika ada
            if ($user->profile_photo_path && Storage::exists('public/' . $user->profile_photo_path)) {
                Storage::delete('public/' . $user->profile_photo_path);
            }

            // Simpan foto profil baru
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile photo updated successfully.');
    }

    public function showDeviceInfo()
    {
        $userAgent = Session::get('user_agent');
        return view('device-info', ['userAgent' => $userAgent]);
    }
}
