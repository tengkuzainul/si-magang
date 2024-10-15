<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusans = Jurusan::with('kelas')->get();

        $title = 'Delete Jurusan!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('pages.jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('pages.jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kd_jurusan' => 'required|min:3|max:30|unique:jurusans,kd_jurusan',
            'nama_jurusan' => 'required|string|unique:jurusans,nama_jurusan',
        ]);

        Jurusan::create([
            'kd_jurusan' => $request->kd_jurusan,
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('jurusan.index')
            ->with('success', 'Data Added Successfully!');
    }

    public function edit(string $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        return view('pages.jurusan.edit', compact('jurusan'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $request->validate([
            'kd_jurusan' => 'sometimes|min:3|max:30|unique:jurusans,kd_jurusan,' . $jurusan->id,
            'nama_jurusan' => 'sometimes|string|unique:jurusans,nama_jurusan,' . $jurusan->id,
        ]);

        $jurusan->update([
            'kd_jurusan' => $request->kd_jurusan,
            'nama_jurusan' => $request->nama_jurusan,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('jurusan.index')
            ->with('success', 'Data Added Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $jurusan->delete();

        return redirect()->route('jurusan.index')
            ->with('success', 'Data Deleted Successfully!');
    }
}
