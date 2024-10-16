<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $siswaCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'siswa');
        })->count();

        $guruCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'guru-pembimbing');
        })->count();

        $jurusanCount = Jurusan::count();

        $kelasCount = Kelas::count();

        $activities = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['guru-pembimbing', 'siswa']);
        })
            ->orderBy('last_login_at', 'desc')
            ->take(5)
            ->get();

        $lastLogins = [];

        foreach ($activities as $activity) {
            $lastLogins[] = [
                'name' => $activity->name,
                'image' => $activity->image,
                'last_login' => $activity->last_login_at ? Carbon::parse($activity->last_login_at)->diffForHumans() : 'Belum Pernah Login',
            ];
        }


        return view('home', compact('siswaCount', 'guruCount', 'jurusanCount', 'kelasCount', 'lastLogins'));
    }
}
