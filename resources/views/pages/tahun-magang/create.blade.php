@extends('layouts.app', ['title' => 'Tahun Magang'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tahun Magang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Master Data</div>
                <div class="breadcrumb-item"><a href="{{ route('tahun-magang.create') }}">Create</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section-title">Create Tahun Magang</h2>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Form Create Tahun Magang</h4>
                        </div>
                        <form action="{{ route('tahun-magang.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="kode_magang">Kode Tahun
                                                Magang</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-qrcode"></i>
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
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="tahun_ajaran_magang">Tahun
                                                Ajaran
                                                Magang</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-calendar-check"></i>
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
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="tanggal_mulai">Tanggal Mulai
                                                magang</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                                                    value="{{ old('tanggal_mulai') }}"
                                                    class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                                    placeholder="" aria-label="Tanggal Mulai">

                                                @error('tanggal_mulai')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="tanggal_selesai">Tanggal
                                                Selesai
                                                Magang</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                                    value="{{ old('tanggal_selesai') }}"
                                                    class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                                    placeholder="" aria-label="Tanggal Selesai">

                                                @error('tanggal_selesai')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-danger px-3 btn-rounded" type="reset">
                                        <i class="fas fa-undo mr-2"></i>Reset
                                    </button>

                                    <button class="btn btn-success btn-rounded px-3" type="submit">
                                        <i class="fas fa-check-circle mr-2"></i>Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
