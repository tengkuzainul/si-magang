<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with('jurusan')->get();
        $jurusans = Jurusan::all();

        $title = 'Delete Kelas!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('pages.kelas.index', compact('kelas', 'jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kd_kelas' => 'required|min:3|max:30|unique:kelas,kd_kelas',
            'nama_kelas' => 'required|string|unique:kelas,nama_kelas',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        Kelas::create([
            'kd_kelas' => $request->kd_kelas,
            'nama_kelas' => $request->nama_kelas,
            'jurusan_id' => $request->jurusan_id,
        ]);

        return redirect()->route('kelas.index')
            ->with('success', 'Data Added Successfully!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'kd_kelas' => 'sometimes|string|min:3|max:30|unique:kelas,kd_kelas,' . $kelas->id,
            'nama_kelas' => 'sometimes|string|unique:kelas,nama_kelas,' . $kelas->id,
            'jurusan_id' => 'sometimes|exists:jurusans,id',
        ]);

        $kelas->update([
            'kd_kelas' => $request->kd_kelas,
            'nama_kelas' => $request->nama_kelas,
            'jurusan_id' => $request->jurusan_id,
        ]);

        return redirect()->route('kelas.index')
            ->with('success', 'Data Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();

        return redirect()->back()
            ->with('success', 'Data Deleted Successfully!');
    }
}
