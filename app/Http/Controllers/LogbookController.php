<?php

namespace App\Http\Controllers;

use App\Models\LogBook;
use App\Models\Magang;
use App\Models\TahunMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogBookController extends Controller
{
    public function selectTahunMagang(Request $request)
    {
        $user = Auth::user();

        $tahunAjaran = TahunMagang::all();

        if ($user->hasRole('siswa')) {
            $magang = Magang::with('tahunAjaran')
                ->where('siswa_id', $user->id)
                ->get();
        } elseif ($user->hasRole('super-admin')) {
            $magang = Magang::with('tahunAjaran')->get();
        } else {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        return view('pages.logbook.index', compact('magang', 'tahunAjaran'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $magangID = Magang::findOrFail($id);

        $request->validate([
            'deskripsi' => [
                'required',
                function ($attribute, $value, $fail) {
                    $wordCount = str_word_count($value);
                    if ($wordCount > 100) {
                        $fail('Deskripsi tidak boleh lebih dari 100 kata.');
                    }
                },
            ],
            'lampiran_foto' => 'required|image|mimes:jpeg,jpg,png|max:2040',
        ]);

        if ($request->hasFile('lampiran_foto')) {
            $lampiranFoto = $request->file('lampiran_foto');
            $lampiranFotoName = time() . '_lampiran_foto.' . $lampiranFoto->getClientOriginalExtension();
            $lampiranFoto->move(public_path('lampiran-foto-logbook'), $lampiranFotoName);
        }

        LogBook::create([
            'magang_id' => $magangID->id,
            'deskripsi' => $request->deskripsi,
            'lampiran_foto' => $lampiranFotoName,
            'status' => 'Menunggu',
        ]);

        return redirect()->back()->with('success', 'Logbook Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function ubahStatus(string $id)
    {
        $logbook = LogBook::findOrFail($id);

        $user = Auth::user();
        if ($user->hasAnyRole(['super-admin', 'guru-pembimbing'])) {

            if ($logbook->status != 'Disetujui') {
                $logbook->status = 'Disetujui';
                $logbook->save();
                return redirect()->back()->with('success', 'Status logbook berhasil diubah menjadi Disetujui.');
            } else {
                $logbook->status = 'Menunggu';
                $logbook->save();
                return redirect()->back()->with('success', 'Status logbook disetujui berhasil dibatalkan!');
            }

            return redirect()->back()->with('info', 'Logbook sudah disetujui sebelumnya.');
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengubah status logbook.');
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
