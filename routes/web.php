<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\TahunMagangController;
use App\Http\Controllers\UserManageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'password.confirm' => false,
    'password.email' => false,
    'password.request' => false,
    'password.reset' => false,
    'password.update' => false,
]);

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['role:super-admin']);

Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::controller(UserManageController::class)->prefix('user-manage')->group(function () {
        Route::get('/all-user', 'allUser')->name('user.all');
        Route::get('/siswa', 'siswaUser')->name('user.siswa');
        Route::get('/guru-pembimbing', 'gurpemUser')->name('user.guru-pembimbing');
        Route::get('/create', 'create')->name('user.create');
    });

    Route::controller(KelasController::class)->prefix('kelas')->group(function () {
        Route::get('/index', 'index')->name('kelas.index');
        Route::get('/create', 'create')->name('kelas.create');
        Route::post('/store', 'store')->name('kelas.store');
        Route::put('/update/{id}', 'update')->name('kelas.update');
        Route::delete('/destroy/{id}', 'destroy')->name('kelas.destroy');
    });

    Route::controller(JurusanController::class)->prefix('jurusan')->group(function () {
        Route::get('/index', 'index')->name('jurusan.index');
        Route::post('/store', 'store')->name('jurusan.store');
        Route::put('/update/{id}', 'update')->name('jurusan.update');
        Route::delete('/destroy/{id}', 'destroy')->name('jurusan.destroy');
    });

    Route::controller(TahunMagangController::class)->prefix('tahun-magang')->group(function () {
        Route::get('/index', 'index')->name('tahun-magang.index');
        Route::get('/create', 'create')->name('tahun-magang.create');
        Route::post('/store', 'store')->name('tahun-magang.store');
        Route::get('/edit/{id}', 'edit')->name('tahun-magang.edit');
        Route::put('/update/{id}', 'update')->name('tahun-magang.update');
        Route::delete('/destroy/{id}', 'destroy')->name('tahun-magang.destroy');
    });

    Route::controller(MagangController::class)->prefix('magang')->group(function () {
        Route::get('/index', 'index')->name('magang.index');
        Route::get('/create', 'create')->name('magang.create');
        Route::post('/store', 'store')->name('magang.store');
        Route::get('/edit/{id}', 'edit')->name('magang.edit');
        Route::put('/update/{id}', 'update')->name('magang.update');
        Route::delete('/destroy/{id}', 'destroy')->name('magang.destroy');
    });

    Route::controller(LogbookController::class)->prefix('logbook')->group(function () {
        Route::get('/index', 'index')->name('logbook.index');
        Route::get('/create', 'create')->name('logbook.create');
        Route::post('/store', 'store')->name('logbook.store');
        Route::get('/edit/{id}', 'edit')->name('logbook.edit');
        Route::put('/update/{id}', 'update')->name('logbook.update');
        Route::delete('/destroy/{id}', 'destroy')->name('logbook.destroy');
    });
});
