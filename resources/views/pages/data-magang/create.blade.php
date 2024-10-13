@extends('layouts.app', ['title' => 'Data Magang'])

@section('breadcrumb')
    <div class="breadcrumb-wrapper">
        <h1>Create Data Magang</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <span class="mdi mdi-home"></span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    Data Magang
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
                    <h2>Create Data Magang</h2>
                </div>

                <div class="card-body">
                    <form action="{{ route('magang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row align-items-cen">
                            @role('super-admin')
                                <div class="col-sm-12">
                                    <label class="text-dark font-weight-medium" for="nama_siswa">Select Siswa</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-school"></i>
                                            </span>
                                        </div>
                                        <select name="nama_siswa" id="nama_siswa"
                                            class="form-control @error('nama_siswa') is-invalid @enderror">
                                            <option selected disabled>--- SELECT ---</option>

                                            @foreach ($siswa as $data)
                                                <option value="{{ $data->id }}"
                                                    {{ old('nama_siswa') == $data->id ? 'selected' : '' }}>
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('nama_siswa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endrole

                            <div class="col-sm-6">
                                <label class="text-dark font-weight-medium" for="guru_pembimbing">Select Guru
                                    Pembimbing</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-account-multiple"></i>
                                        </span>
                                    </div>
                                    <select name="guru_pembimbing" id="guru_pembimbing"
                                        class="form-control @error('guru_pembimbing') is-invalid @enderror">
                                        <option selected disabled>--- SELECT ---</option>

                                        @foreach ($guru as $data)
                                            <option value="{{ $data->id }}"
                                                {{ old('guru_pembimbing') == $data->id ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('guru_pembimbing')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="text-dark font-weight-medium" for="tahun_magang">Select Tahun Ajaran
                                    Magang</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-calendar"></i>
                                        </span>
                                    </div>
                                    <select name="tahun_magang" id="tahun_magang"
                                        class="form-control @error('tahun_magang') is-invalid @enderror">
                                        <option selected disabled>--- SELECT ---</option>

                                        @foreach ($tahunMagang as $data)
                                            <option value="{{ $data->id }}"
                                                {{ old('tahun_magang') == $data->id ? 'selected' : '' }}>
                                                {{ $data->tahun_magang . ' | (' . $data->kd_tahun_magang . ')' }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('tahun_magang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label class="text-dark font-weight-medium" for="tempat_magang">Tempat Magang</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-home-modern"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="tempat_magang" id="tempat_magang"
                                        value="{{ old('tempat_magang') }}"
                                        class="form-control @error('tempat_magang') is-invalid @enderror"
                                        placeholder="Tempat Magang" aria-label="Tempat Magang">

                                    @error('tempat_magang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="text-dark font-weight-medium" for="surat_magang">Lampiran Surat
                                    Magang (Gambar: JPEG, JPG, PNG)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-file"></i>
                                        </span>
                                    </div>
                                    <input type="file" name="surat_magang" id="surat_magang"
                                        value="{{ old('surat_magang') }}"
                                        class="form-control @error('surat_magang') is-invalid @enderror"
                                        placeholder="Surat magang" aria-label="Surat magang">

                                    @error('surat_magang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="text-dark font-weight-medium" for="surat_balasan">Lampiran Surat
                                    Balasan (Gambar: JPEG, JPG, PNG)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-file"></i>
                                        </span>
                                    </div>
                                    <input type="file" name="surat_balasan" id="surat_balasan"
                                        value="{{ old('surat_balasan') }}"
                                        class="form-control @error('surat_balasan') is-invalid @enderror"
                                        placeholder="Surat Balasan" aria-label="Surat Balasan">

                                    @error('surat_balasan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
