<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allUser()
    {
        $users = User::with('roles')->get();

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

        return view('pages.user-manage.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
