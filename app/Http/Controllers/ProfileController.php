<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        return view('home', compact('profile'));
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profile = Profile::first();
        
        if ($profile->profile_image) {
            Storage::disk('public')->delete($profile->profile_image);
        }

        $path = $request->file('profile_image')->store('profile_images', 'public');
        
        $profile->update([
            'profile_image' => $path,
        ]);

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}
