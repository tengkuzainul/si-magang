@extends('layouts.app', ['title' => 'Kelas Data'])

@section('breadcrumb')
    <div class="breadcrumb-wrapper">
        <h1>Kelas Data</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <span class="mdi mdi-home"></span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    Kelas
                </li>
                <li class="breadcrumb-item" aria-current="page">Data</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Data Kelas</h2>

                    <a href="#" class="btn btn-outline-primary btn-sm text-uppercase" data-toggle="modal"
                        data-target="#modalCreateKelas">
                        <i class=" mdi mdi-account-plus mr-1"></i>Add New Data
                    </a>
                </div>

                <!-- Modal Create Kelas -->
                <div class="modal fade" id="modalCreateKelas" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLarge" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLarge">Create Data Kelas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="modal-body">
                                    <!-- Kode Kelas -->
                                    <label class="text-dark font-weight-medium" for="kd_kelas">Kode Kelas</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-qrcode"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="kd_kelas" id="kd_kelas" value="{{ old('kd_kelas') }}"
                                            class="form-control @error('kd_kelas') is-invalid @enderror"
                                            placeholder="Kode Kelas" aria-label="Kode Kelas" autofocus>
                                        @error('kd_kelas')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Nama Kelas -->
                                    <label class="text-dark font-weight-medium" for="nama_kelas">Nama Kelas</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-home-variant"></i>
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

                                    <!-- Select Jurusan -->
                                    <label class="text-dark font-weight-medium" for="jurusan_id">Select Jurusan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-home-variant"></i>
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

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button class="ladda-button btn btn-danger btn-square btn-ladda" data-style="slide-left"
                                        type="reset">
                                        <span class="ladda-label"><i class="mdi mdi-replay mr-2"></i>Reset!</span>
                                    </button>

                                    <button class="ladda-button btn btn-success btn-square btn-ladda"
                                        data-style="slide-left" type="submit">
                                        <span class="ladda-label"><i
                                                class="mdi mdi-checkbox-marked-outline mr-2"></i>Submit!</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Tabel Data Kelas -->
                <div class="card-body">
                    <div class="responsive-data-table">
                        <table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Kelas</th>
                                    <th>Nama Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($kelas as $kelasId)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><span
                                                class="mb-2 mr-2 badge badge-warning rounded">{{ $kelasId->kd_kelas }}</span>
                                        </td>
                                        <td>{{ $kelasId->nama_kelas }}</td>
                                        <td>
                                            <span
                                                class="mb-2 mr-2 badge badge-secondary rounded">{{ $kelasId->jurusan->nama_jurusan }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center g-2">
                                                <!-- Edit Button -->
                                                <a href="#" class="mb-1 btn btn-primary btn-sm mr-2"
                                                    data-toggle="modal"
                                                    data-target="#modalUpdateKelas-{{ $kelasId->id }}">
                                                    <i class=" mdi mdi-pencil-box"></i>
                                                </a>

                                                <!-- Delete Button -->
                                                <a href="{{ route('kelas.destroy', $kelasId->id) }}"
                                                    class="mb-1 btn btn-danger btn-sm" data-confirm-delete="true">
                                                    <i class=" mdi mdi-delete"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Update Kelas -->
                                    <div class="modal fade" id="modalUpdateKelas-{{ $kelasId->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLarge">Update Data Kelas</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <!-- Form Update Kelas -->
                                                <form action="{{ route('kelas.update', $kelasId->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-body">
                                                        <!-- Kode Kelas -->
                                                        <label class="text-dark font-weight-medium" for="kd_kelas">Kode
                                                            Kelas</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="mdi mdi-qrcode"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" name="kd_kelas" id="kd_kelas"
                                                                value="{{ old('kd_kelas', $kelasId->kd_kelas) }}"
                                                                class="form-control @error('kd_kelas') is-invalid @enderror"
                                                                placeholder="Kode Kelas" aria-label="Kode Kelas"
                                                                autofocus>
                                                            @error('kd_kelas')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <!-- Nama Kelas -->
                                                        <label class="text-dark font-weight-medium" for="nama_kelas">Nama
                                                            Kelas</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="mdi mdi-home-variant"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" name="nama_kelas" id="nama_kelas"
                                                                value="{{ old('nama_kelas', $kelasId->nama_kelas) }}"
                                                                class="form-control @error('nama_kelas') is-invalid @enderror"
                                                                placeholder="Nama Kelas" aria-label="Nama Kelas">
                                                            @error('nama_kelas')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <!-- Select Jurusan -->
                                                        <label class="text-dark font-weight-medium"
                                                            for="jurusan_id">Select Jurusan</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="mdi mdi-home-variant"></i>
                                                                </span>
                                                            </div>
                                                            <select name="jurusan_id" id="jurusan_id"
                                                                class="form-control @error('jurusan_id') is-invalid @enderror">
                                                                <option selected disabled>--- SELECT ---</option>
                                                                @foreach ($jurusans as $jurusan)
                                                                    <option value="{{ $jurusan->id }}"
                                                                        {{ old('jurusan_id', $kelasId->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                                                                        {{ $jurusan->nama_jurusan }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('jurusan_id')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- Modal Footer -->
                                                    <div class="modal-footer">
                                                        <button class="ladda-button btn btn-danger btn-square btn-ladda"
                                                            data-style="slide-left" type="reset">
                                                            <span class="ladda-label"><i
                                                                    class="mdi mdi-replay mr-2"></i>Reset!</span>
                                                        </button>

                                                        <button class="ladda-button btn btn-success btn-square btn-ladda"
                                                            data-style="slide-left" type="submit">
                                                            <span class="ladda-label"><i
                                                                    class="mdi mdi-checkbox-marked-outline mr-2"></i>Submit!</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
