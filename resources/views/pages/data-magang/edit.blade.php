@extends('layouts.app', ['title' => 'Data Magang'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Magang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Magang</div>
                <div class="breadcrumb-item"><a href="{{ route('tahun-magang.edit', $magang->id) }}">Edit</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section-title">Edit Data Magang</h2>
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Form Edit Data Magang</h4>
                        </div>
                        <form action="{{ route('magang.update', $magang->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row align-items-center">
                                    @role('super-admin')
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-dark font-weight-medium" for="nama_siswa">Select
                                                    Siswa</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-graduation-cap"></i>
                                                        </span>
                                                    </div>
                                                    <select name="nama_siswa" id="nama_siswa"
                                                        class="form-control @error('nama_siswa') is-invalid @enderror">
                                                        <option selected disabled>--- SELECT ---</option>

                                                        @foreach ($siswa as $data)
                                                            <option value="{{ $data->id }}"
                                                                {{ old('nama_siswa', $magang->siswa_id) == $data->id ? 'selected' : '' }}>
                                                                {{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('nama_siswa')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endrole

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="guru_pembimbing">Select Guru
                                                Pembimbing</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-chalkboard-teacher"></i>
                                                    </span>
                                                </div>
                                                <select name="guru_pembimbing" id="guru_pembimbing"
                                                    class="form-control @error('guru_pembimbing') is-invalid @enderror">
                                                    <option selected disabled>--- SELECT ---</option>

                                                    @foreach ($guru as $data)
                                                        <option value="{{ $data->id }}"
                                                            {{ old('guru_pembimbing', $magang->guru_id) == $data->id ? 'selected' : '' }}>
                                                            {{ $data->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('guru_pembimbing')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="tahun_magang">Select Tahun
                                                Ajaran
                                                Magang</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-calendar-check"></i>
                                                    </span>
                                                </div>
                                                <select name="tahun_magang" id="tahun_magang"
                                                    class="form-control @error('tahun_magang') is-invalid @enderror">
                                                    <option selected disabled>--- SELECT ---</option>

                                                    @foreach ($tahunMagang as $data)
                                                        <option value="{{ $data->id }}"
                                                            {{ old('tahun_magang', $magang->tahun_magang_id) == $data->id ? 'selected' : '' }}>
                                                            {{ $data->tahun_magang . ' | (' . $data->kd_tahun_magang . ')' }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('tahun_magang')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="tempat_magang">Tempat
                                                Magang</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-building"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="tempat_magang" id="tempat_magang"
                                                    value="{{ old('tempat_magang', $magang->tempat_magang) }}"
                                                    class="form-control @error('tempat_magang') is-invalid @enderror"
                                                    placeholder="Tempat Magang" aria-label="Tempat Magang">

                                                @error('tempat_magang')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="surat_magang">Lampiran Surat
                                                Magang (Gambar: JPEG, JPG, PNG)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-image"></i>
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
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="surat_balasan">Lampiran Surat
                                                Balasan (Gambar: JPEG, JPG, PNG)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-image"></i>
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

                <div class="col-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-l2 mb-3">
                                    <p class="text-dark font-weight-medium mb-2">Surat Magang Sebelumnya</p>

                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('surat-magang/' . $magang->surat_magang) }}"
                                            alt="{{ $magang->surat_magang }}" class="img-fluid">
                                    </div>
                                </div>

                                <div class="col-l2 mb-3">
                                    <p class="text-dark font-weight-medium mb-2">Surat Balasan Sebelumnya</p>

                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('surat-balasan/' . $magang->surat_balasan) }}"
                                            alt="{{ $magang->surat_balasan }}" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
