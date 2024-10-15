<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allUser()
    {
        $users = User::with('roles', 'kelas')->get();

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('pages.user-manage.all-user', compact('users'));
    }

    public function siswaUser()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'siswa');
        })->get();

        return view('pages.user-manage.siswa-user', compact('users'));
    }

    public function gurpemUser()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'guru-pembimbing');
        })->get();

        return view('pages.user-manage.dospem-user', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $kelas = Kelas::all();

        return view('pages.user-manage.create', compact('roles', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required|exists:roles,name',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        if ($request->input('role')) {
            $user->assignRole($request->input('role'));
        }

        if ($request->hasFile('image')) {
            $imageProfile = $request->file('image');
            $imageProfileName = time() . '_image-profile.' . $imageProfile->getClientOriginalExtension();
            $imageProfile->move(public_path('image-profile'), $imageProfileName);
            $user->image = $imageProfileName;
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->kelas_id = $request->input('kelas_id');
        $user->save();

        return redirect()->route('user.all')->with('success', 'Data created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('roles', 'kelas')->findOrFail($id);
        $roles = Role::all();
        $kelas = Kelas::all();

        return view('pages.user-manage.edit', compact('user', 'roles', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::with('roles', 'kelas')->findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'sometimes|string|max:255',
            'kelas_id' => 'sometimes|exists:kelas,id',
            'username' => 'sometimes|string|max:255|unique:users,username,' . $user->id,
            'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id,
            'role' => 'sometimes|exists:roles,name',
            'password' => 'nullable|string|confirmed',
        ]);

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
            'kelas_id' => $request->input('kelas_id', $user->kelas_id),
            'username' => $request->input('username', $user->username),
            'email' => $request->input('email', $user->email),
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            'image' => $imageProfileName,
        ]);

        if ($request->filled('role')) {
            $user->syncRoles([$request->role]);
        }

        return redirect()->route('user.all')->with('success', 'Data Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->image && File::exists(public_path('image-profile/' . $user->image))) {
            File::delete(public_path('image-profile/' . $user->image));
        }

        $user->delete();

        return redirect()->back()->with('success', 'Data Deleted Successfully!');
    }
}
