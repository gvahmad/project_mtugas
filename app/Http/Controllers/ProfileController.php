<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        // Handle photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo && $user->profile_photo !== 'default-profile.png') {
                $oldPhoto = public_path('img/profile/' . $user->profile_photo);
                if (file_exists($oldPhoto)) {
                    unlink($oldPhoto);
                }
            }

            // Save new photo
            $file = $request->file('profile_photo');
            $filename = 'user_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/profile'), $filename);
            $user->profile_photo = $filename;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Refresh the authenticated user in the session so UI (navbar/sidebar) shows new photo immediately
        // This avoids requiring the user to re-login to see their updated profile image.
        Auth::login($user);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
