<?php

namespace App\Http\Controllers;

use App\Models\TahunMagang;
use Illuminate\Http\Request;

class TahunMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $magangs = TahunMagang::latest()->get();

        $title = 'Delete Tahun Magang!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('pages.tahun-magang.index', compact('magangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.tahun-magang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_magang' => 'required|unique:tahun_magangs,kd_tahun_magang|string|min:1|max:30',
            'tahun_ajaran_magang' => 'required|unique:tahun_magangs,tahun_magang|min:2|max:30',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|',
        ]);

        TahunMagang::create([
            'kd_tahun_magang' => $request->kode_magang,
            'tahun_magang' => $request->tahun_ajaran_magang,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status_logbook' => 'Aktif',
        ]);

        return redirect()->route('tahun-magang.index')->with('success', 'Data Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $magang = TahunMagang::findOrFail($id);

        return view('pages.tahun-magang.edit', compact('magang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $magang = TahunMagang::findOrFail($id);

        $request->validate([
            'kode_magang' => 'sometimes|string|min:1|max:30|unique:tahun_magangs,kd_tahun_magang,' . $magang->id,
            'tahun_ajaran_magang' => 'sometimes|string|min:2|max:30|unique:tahun_magangs,tahun_magang,' . $magang->id,
            'tanggal_mulai' => 'sometimes|date',
            'tanggal_selesai' => 'sometimes|date',
        ]);

        $magang->update([
            'kd_tahun_magang' => $request->kode_magang,
            'tahun_magang' => $request->tahun_ajaran_magang,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status_logbook' => 'Aktif',
        ]);

        return redirect()->route('tahun-magang.index')->with('success', 'Data Updated Successfully!');
    }

    public function ubahStatusLogbook(Request $request, string $id)
    {
        $tahunMagang = TahunMagang::findOrFail($id);

        if ($tahunMagang->status_logbook == 'Tutup') {
            $tahunMagang->status_logbook = 'Aktif';
            $tahunMagang->save();

            return redirect()->back()->with('success', 'Status Logbook Sudah Diaktifkan!');
        } else {
            $tahunMagang->status_logbook = 'Tutup';
            $tahunMagang->save();

            return redirect()->back()->with('success', 'Status Logbook Sudah Ditutup!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $magang = TahunMagang::findOrFail($id);

        $magang->delete();

        return redirect()->back()
            ->with('success', 'Data Deleted Successfully!');
    }
}
