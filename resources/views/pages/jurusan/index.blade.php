@extends('layouts.app', ['title' => 'Jurusan Data'])

@section('breadcrumb')
    <div class="breadcrumb-wrapper">
        <h1>Jurusan Data</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <span class="mdi mdi-home"></span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    Jurusan
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
                    <h2>Data Jurusan</h2>

                    <a href="#" class="btn btn-outline-primary btn-sm text-uppercase" data-toggle="modal"
                        data-target="#modalCreateJurusan">
                        <i class=" mdi mdi-account-plus mr-1"></i>Add
                        New Data
                    </a>
                </div>

                <div class="modal fade" id="modalCreateJurusan" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLarge" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLarge">Create Data Jurusan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="{{ route('jurusan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="modal-body">
                                    <label class="text-dark font-weight-medium" for="kd_jurusan">Kode Jurusan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-qrcode"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="kd_jurusan" id="kd_jurusan"
                                            value="{{ old('kd_jurusan') }}"
                                            class="form-control @error('kd_jurusan') is-invalid @enderror"
                                            placeholder="Kode Jurusan" aria-label="Kode Jurusan" autofocus>
                                    </div>

                                    <label class="text-dark font-weight-medium" for="nama_jurusan">
                                        Nama Jurusan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-home-variant"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="nama_jurusan" id="nama_jurusan"
                                            value="{{ old('nama_jurusan') }}"
                                            class="form-control @error('nama_jurusan') is-invalid @enderror"
                                            placeholder="Nama Jurusan" aria-label="Nama Jurusan">
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button class="ladda-button btn btn-danger btn-square btn-ladda" data-style="slide-left"
                                        type="reset">
                                        <span class="ladda-label"><i class="mdi mdi-replay mr-2"></i>Reset!</span>
                                        <span class="ladda-spinner"></span>
                                    </button>

                                    <button class="ladda-button btn btn-success btn-square btn-ladda"
                                        data-style="slide-left" type="submit">
                                        <span class="ladda-label"><i
                                                class="mdi mdi-checkbox-marked-outline mr-2"></i>Submit!</span>
                                        <span class="ladda-spinner"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="responsive-data-table">
                        <table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Jurusan</th>
                                    <th>Nama Jurusan</th>
                                    <th>List Kelas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($jurusans as $jurusan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><span
                                                class="mb-2 mr-2 badge badge-warning rounded">{{ $jurusan->kd_jurusan }}</span>
                                        </td>
                                        <td>{{ $jurusan->nama_jurusan }}</td>
                                        <td>
                                            @forelse ($jurusan->kelas as $item)
                                                <span
                                                    class="mb-2 mr-2 badge badge-secondary rounded">{{ $item->nama_kelas }}</span>
                                            @empty
                                                <span class="mb-2 mr-2 badge badge-danger rounded">Belum ada kelas</span>
                                            @endforelse
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center g-2">
                                                <a href="#" class="mb-1 btn btn-primary btn-sm mr-2"
                                                    data-toggle="modal" data-target="#modalUpdateKelas-{{ $jurusan->id }}">
                                                    <i class=" mdi mdi-pencil-box"></i></a>

                                                <a href="{{ route('jurusan.destroy', $jurusan->id) }}"
                                                    class="mb-1 btn btn-danger btn-sm" data-confirm-delete="true">
                                                    <i class=" mdi mdi-delete"></i></a>
                                            </div>
                                        </td>

                                        <div class="modal fade" id="modalUpdateKelas-{{ $jurusan->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLarge">Update Data Jurusan
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form action="{{ route('jurusan.update', $jurusan->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="modal-body">
                                                            <label class="text-dark font-weight-medium"
                                                                for="kd_jurusan">Kode Jurusan</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="mdi mdi-qrcode"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" name="kd_jurusan" id="kd_jurusan"
                                                                    value="{{ old('kd_jurusan', $jurusan->kd_jurusan) }}"
                                                                    class="form-control @error('kd_jurusan') is-invalid @enderror"
                                                                    placeholder="Kode Kelas" aria-label="Kode Kelas"
                                                                    autofocus>
                                                            </div>

                                                            <label class="text-dark font-weight-medium"
                                                                for="nama_jurusan">
                                                                Nama Jurusan</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="mdi mdi-home-variant"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" name="nama_jurusan"
                                                                    id="nama_jurusan"
                                                                    value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}"
                                                                    class="form-control @error('nama_jurusan') is-invalid @enderror"
                                                                    placeholder="Nama Jurusan" aria-label="Nama Jurusan">
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button
                                                                class="ladda-button btn btn-danger btn-square btn-ladda"
                                                                data-style="slide-left" type="reset">
                                                                <span class="ladda-label"><i
                                                                        class="mdi mdi-replay mr-2"></i>Reset!</span>
                                                                <span class="ladda-spinner"></span>
                                                            </button>

                                                            <button
                                                                class="ladda-button btn btn-success btn-square btn-ladda"
                                                                data-style="slide-left" type="submit">
                                                                <span class="ladda-label"><i
                                                                        class="mdi mdi-checkbox-marked-outline mr-2"></i>Submit!</span>
                                                                <span class="ladda-spinner"></span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
