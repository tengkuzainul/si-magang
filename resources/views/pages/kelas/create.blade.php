@extends('layouts.app', ['title' => 'Kelas'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kelas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Master Data</div>
                <div class="breadcrumb-item"><a href="{{ route('kelas.create') }}">Create</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section-title">Create Kelas</h2>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Form Create Kelas</h4>
                        </div>
                        <form action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <!-- Kode Kelas -->
                                            <label class="text-dark font-weight-medium" for="kd_kelas">Kode Kelas</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-qrcode"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="kd_kelas" id="kd_kelas"
                                                    value="{{ old('kd_kelas') }}"
                                                    class="form-control @error('kd_kelas') is-invalid @enderror"
                                                    placeholder="Kode Kelas" aria-label="Kode Kelas" autofocus>
                                                @error('kd_kelas')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <!-- Nama Kelas -->
                                            <label class="text-dark font-weight-medium" for="nama_kelas">Nama Kelas</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-school"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="nama_kelas" id="nama_kelas"
                                                    value="{{ old('nama_kelas') }}"
                                                    class="form-control @error('nama_kelas') is-invalid @enderror"
                                                    placeholder="Nama Kelas" aria-label="Nama Kelas">
                                                @error('nama_kelas')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <!-- Select Jurusan -->
                                            <label class="text-dark font-weight-medium" for="jurusan_id">Select
                                                Jurusan</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-stream"></i>
                                                    </span>
                                                </div>
                                                <select name="jurusan_id" id="jurusan_id"
                                                    class="form-control @error('jurusan_id') is-invalid @enderror">
                                                    <option selected disabled>--- SELECT ---</option>
                                                    @foreach ($jurusans as $jurusan)
                                                        <option value="{{ $jurusan->id }}"
                                                            {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                                            {{ $jurusan->nama_jurusan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('jurusan_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
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
