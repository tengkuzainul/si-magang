<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Models\TahunMagang;
use App\Models\User;
use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userID = Auth::user();

        if ($userID->hasRole('siswa')) {
            $dataMagangs = Magang::with('siswa', 'guruPembimbing', 'tahunAjaran', 'logbooks')
                ->where('siswa_id', $userID->id)->get();
        } elseif ($userID->hasRole('guru-pembimbing')) {
            $dataMagangs = Magang::with('siswa', 'guruPembimbing', 'tahunAjaran', 'logbooks')
                ->where('guru_id', $userID->id)->get();
        } else {
            $dataMagangs = Magang::with('siswa', 'guruPembimbing', 'tahunAjaran', 'logbooks')
                ->latest()->get();
        }


        $title = 'Delete Magang!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('pages.data-magang.index', compact('dataMagangs'));
    }

    public function tambahDataLogBook(string $id)
    {
        $tahunAjaran = TahunMagang::all();
        $user = Auth::user();

        if ($user->hasRole('siswa')) {
            $magang = Magang::with('siswa', 'guruPembimbing', 'tahunAjaran', 'logbooks')
                ->where('siswa_id', $user->id)
                ->firstOrFail();
        } elseif ($user->hasRole('super-admin') || $user->hasRole('guru-pembimbing')) {
            $magang = Magang::with('siswa', 'guruPembimbing', 'tahunAjaran', 'logbooks')
                ->findOrFail($id);
        } else {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        return view('pages.logbook.index', compact('magang', 'tahunAjaran'));
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

        return redirect()->route('magang.index')->with('success', 'Data Added Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $magang = Magang::with('siswa', 'guruPembimbing', 'tahunAjaran', 'logbooks')
            ->findOrFail($id);

        $guru = User::whereHas('roles', function ($query) {
            $query->where('name', 'guru-pembimbing');
        })->get();

        $siswa = User::whereHas('roles', function ($query) {
            $query->where('name', 'siswa');
        })->get();

        $tahunMagang = TahunMagang::latest()->get();

        return view('pages.data-magang.edit', compact('magang', 'guru', 'siswa', 'tahunMagang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $magang = Magang::findOrFail($id);

        $request->validate([
            'nama_siswa' => 'sometimes|exists:users,id',
            'guru_pembimbing' => 'sometimes|exists:users,id',
            'tahun_magang' => 'sometimes|exists:tahun_magangs,id',
            'tempat_magang' => 'sometimes|string|min:1',
            'surat_magang' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
            'surat_balasan' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $suratMagangName = $magang->surat_magang;
        $suratBalasanName = $magang->surat_balasan;

        if ($request->hasFile('surat_magang')) {
            if ($magang->surat_magang && File::exists(public_path('surat-magang/' . $magang->surat_magang))) {
                File::delete(public_path('surat-magang/' . $magang->surat_magang));
            }
            $suratMagang = $request->file('surat_magang');
            $suratMagangName = time() . '_surat_magang.' . $suratMagang->getClientOriginalExtension();
            $suratMagang->move(public_path('surat-magang'), $suratMagangName);
        }

        if ($request->hasFile('surat_balasan')) {
            if ($magang->surat_balasan && File::exists(public_path('surat-balasan/' . $magang->surat_balasan))) {
                File::delete(public_path('surat-balasan/' . $magang->surat_balasan));
            }
            $suratBalasan = $request->file('surat_balasan');
            $suratBalasanName = time() . '_surat_balasan.' . $suratBalasan->getClientOriginalExtension();
            $suratBalasan->move(public_path('surat-balasan'), $suratBalasanName);
        }

        $magang->update([
            'siswa_id' => $request->input('nama_siswa') ?? Auth::user()->id,
            'guru_id' => $request->input('guru_pembimbing'),
            'tahun_magang_id' => $request->input('tahun_magang'),
            'tempat_magang' => $request->input('tempat_magang'),
            'surat_magang' => $suratMagangName,
            'surat_balasan' => $suratBalasanName,
        ]);

        return redirect()->route('magang.index')->with('success', 'Data Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $magang = Magang::findOrFail($id);

        if ($magang->surat_magang && File::exists(public_path('surat-magang/' . $magang->surat_magang))) {
            File::delete(public_path('surat-magang/' . $magang->surat_magang));
        }

        if ($magang->surat_balasan && File::exists(public_path('surat-balasan/' . $magang->surat_balasan))) {
            File::delete(public_path('surat-balasan/' . $magang->surat_balasan));
        }

        $magang->delete();

        return redirect()->back()->with('success', 'Data Deleted Successfully!');
    }
}
