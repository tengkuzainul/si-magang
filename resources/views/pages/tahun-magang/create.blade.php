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
                                        placeholder="Kode Magang" aria-label="Kode Magang">

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
                                            <i class="mdi mdi-qrcode"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="tahun_ajaran_magang" id="tahun_ajaran_magang"
                                        value="{{ old('tahun_ajaran_magang') }}"
                                        class="form-control @error('tahun_ajaran_magang') is-invalid @enderror"
                                        placeholder="Tahun Ajaran Magang" aria-label="Tahun Ajaran Magang">

                                    @error('tahun_ajaran_magang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
