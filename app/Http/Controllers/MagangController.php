<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Models\TahunMagang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataMagangs = Magang::with('siswa', 'guruPembimbing', 'tahunAjaran', 'logbooks')->latest()->get();

        return view('pages.data-magang.index', compact('dataMagangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guru = User::whereHas('roles', function ($query) {
            $query->where('name', 'guru-pembimbing');
        })->get();

        $siswa = User::whereHas('roles', function ($query) {
            $query->where('name', 'siswa');
        })->get();

        $tahunMagang = TahunMagang::latest()->get();

        return view('pages.data-magang.create', compact('guru', 'tahunMagang', 'siswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'nullable|exists:users,id',
            'guru_pembimbing' => 'required|exists:users,id',
            'tahun_magang' => 'required|exists:tahun_magangs,id',
            'tempat_magang' => 'required|string|min:1',
            'surat_magang' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'surat_balasan' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('surat_magang')) {
            $suratMagang = $request->file('surat_magang');
            $suratMagangName = time() . '_surat_magang.' . $suratMagang->getClientOriginalExtension();
            $suratMagang->move(public_path('surat-magang'), $suratMagangName);
        }

        if ($request->hasFile('surat_balasan')) {
            $suratBalasan = $request->file('surat_balasan');
            $suratBalasanName = time() . '_surat_balasan.' . $suratBalasan->getClientOriginalExtension();
            $suratBalasan->move(public_path('surat-balasan'), $suratBalasanName);
        }

        Magang::create([
            'siswa_id' => $request->input('nama_siswa') ?? Auth::user()->id,
            'guru_id' => $request->input('guru_pembimbing'),
            'tahun_magang_id' => $request->input('tahun_magang'),
            'tempat_magang' => $request->input('tempat_magang'),
            'surat_magang' => $suratMagangName,
            'surat_balasan' => $suratBalasanName,
        ]);

        return redirect()->route('magang.index')->with('success', 'Data magang berhasil disimpan');
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
