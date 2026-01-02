<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle Image Upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            // Save new image
            $path = $request->file('profile_image')->store('profile-photos', 'public');
            $user->profile_image = $path;
        }

        // Update Text Fields
        $user->name = $request->name;
        $user->contact_number = $request->contact_number;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    
    }
}