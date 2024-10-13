@extends('layouts.app', ['title' => 'Tahun Ajaran Magang'])

@section('breadcrumb')
    <div class="breadcrumb-wrapper">
        <h1>Create Tahun Ajaran Magang</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <span class="mdi mdi-home"></span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    Tahun Ajaran Magang
                </li>
                <li class="breadcrumb-item" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Create Tahun Ajaran Magang</h2>
                </div>

                <div class="card-body">
                    <form action="{{ route('tahun-magang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row align-items-cen">
                            <div class="col-sm-12">
                                <label class="text-dark font-weight-medium" for="kode_magang">Kode Tahun Magang</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-qrcode"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="kode_magang" id="kode_magang"
                                        value="{{ old('kode_magang') }}"
                                        class="form-control @error('kode_magang') is-invalid @enderror"
                                        placeholder="(ex:20241)" aria-label="Kode Magang" autofocus>

                                    @error('kode_magang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label class="text-dark font-weight-medium" for="tahun_ajaran_magang">Tahun Ajaran
                                    Magang</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="string" name="tahun_ajaran_magang" id="tahun_ajaran_magang"
                                        value="{{ old('tahun_ajaran_magang') }}"
                                        class="form-control @error('tahun_ajaran_magang') is-invalid @enderror"
                                        placeholder="(ex:2024/2025)" aria-label="Tahun Ajaran Magang">

                                    @error('tahun_ajaran_magang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label class="text-dark font-weight-medium" for="tanggal_mulai">Tanggal Mulai magang</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                                        value="{{ old('tanggal_mulai') }}"
                                        class="form-control @error('tanggal_mulai') is-invalid @enderror" placeholder=""
                                        aria-label="Tanggal Mulai">

                                    @error('tanggal_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label class="text-dark font-weight-medium" for="tanggal_selesai">Tanggal Selesai
                                    Magang</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                        value="{{ old('tanggal_selesai') }}"
                                        class="form-control @error('tanggal_selesai') is-invalid @enderror" placeholder=""
                                        aria-label="Tanggal Selesai">

                                    @error('tanggal_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button class="ladda-button btn btn-danger btn-square btn-ladda"
                                            data-style="slide-left" type="reset">
                                            <span class="ladda-label"><i class="mdi mdi-replay mr-2"></i>Reset!</span>
                                        </button>

                                        <button class="ladda-button btn btn-success btn-square btn-ladda"
                                            data-style="slide-left" type="submit">
                                            <span class="ladda-label"><i
                                                    class="mdi mdi-checkbox-marked-outline mr-2"></i>Submit!</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
