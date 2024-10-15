@extends('layouts.app', ['title' => 'Jurusan'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Jurusan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Master Data</div>
                <div class="breadcrumb-item"><a href="{{ route('jurusan.create') }}">Create</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section-title">Create Jurusan</h2>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Form Create Jurusan</h4>
                        </div>
                        <form action="{{ route('jurusan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="kd_jurusan">Kode
                                                Jurusan</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="faas fa-qrcode"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="kd_jurusan" id="kd_jurusan"
                                                    value="{{ old('kd_jurusan') }}"
                                                    class="form-control @error('kd_jurusan') is-invalid @enderror"
                                                    placeholder="Kode Jurusan" aria-label="Kode Jurusan" autofocus>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="nama_jurusan">
                                                Nama Jurusan</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-stream"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="nama_jurusan" id="nama_jurusan"
                                                    value="{{ old('nama_jurusan') }}"
                                                    class="form-control @error('nama_jurusan') is-invalid @enderror"
                                                    placeholder="Nama Jurusan" aria-label="Nama Jurusan">
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
