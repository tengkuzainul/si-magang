@extends('layouts.app', ['title' => 'Lampiran Surat'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Lampiran Surat Siswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Lampiran Surat Siswa</div>
            </div>
        </div>

        <div class="section-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section-title">{{ $lampiranSurat->siswa->name }}</h2>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Lampiran Surat Magang</h4>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('surat-magang/' . $lampiranSurat->surat_magang) }}"
                                alt="{{ $lampiranSurat->surat_magang }}" class="d-flex justify-content-center"
                                width="340" height="500">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Lampiran Surat Balasan</h4>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('surat-balasan/' . $lampiranSurat->surat_balasan) }}"
                                alt="{{ $lampiranSurat->surat_balasan }}" class="d-flex justify-content-center"
                                width="340" height="500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
