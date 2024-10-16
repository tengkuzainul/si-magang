<?php

namespace App\Http\Controllers;

use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile.profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'sometimes|string|max:255',
            'kelas_id' => 'sometimes|exists:kelas,id',
            'username' => 'sometimes|string|max:255|unique:users,username,' . $user->id,
            'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|confirmed',
        ]);

        $imageProfileName = $user->image;

        if ($request->hasFile('image')) {
            if ($user->image && File::exists(public_path('image-profile/' . $user->image))) {
                File::delete(public_path('image-profile/' . $user->image));
            }

            $imageProfile = $request->file('image');
            $imageProfileName = time() . '_image-profile.' . $imageProfile->getClientOriginalExtension();
            $imageProfile->move(public_path('image-profile'), $imageProfileName);
        }

        $user->update([
            'name' => $request->input('name', $user->name),
            'username' => $request->input('username', $user->username),
            'email' => $request->input('email', $user->email),
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            'image' => $imageProfileName,
        ]);

        return redirect()->back()->with('success', 'Profile Updated Successfully!');
    }
}
