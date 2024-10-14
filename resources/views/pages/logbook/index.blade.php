@extends('layouts.app', ['title' => 'Log Book'])

@section('breadcrumb')
    <div class="breadcrumb-wrapper">
        <h1>Log Book</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <span class="mdi mdi-home"></span>
                    </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    Log Boox
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row align-items-start">
        <div class="col-xl-12">
            <form action="" method="GET">
                <div class="d-flex justify-content-end align-items-center">
                    {{-- <div>
                        <label class="text-dark font-weight-medium" for="">Right addon</label>
                        <div class="input-group">
                            <select name="" id="" class="form-control">
                                <option selected>--- PILIH TAHUN AJARAN ---</option>
                            </select>
                            <div class="input-group-append position-relative">
                                <button class="btn btn-primary rounded" type="submit" name=""><i
                                        class="mdi mdi-search mr-2"></i>PILIH</button>
                            </div>
                        </div>
                    </div> --}}

                    <div>
                        <button type="button" class="mb-1 btn btn-primary mr-2 mt-2 float-end" data-toggle="modal"
                            data-target="#modalTambahLogBook">
                            <i class=" mdi mdi-plus-circle mr-2"></i>Log Book
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="card-title text-center mb-1 font-weight-bold text-dark">
                        {{ now()->format('d F Y') }}
                    </h4>
                    <hr class="border-dark">
                    <div class="card-content">
                        <p class="text-dark font-weight-medium text-justify">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus dolorem totam temporibus
                            itaque est aliquam nam iure magnam cupiditate! Sit porro voluptas eaque ratione consequatur,
                            beatae soluta velit nobis aperiam ducimus esse autem temporibus natus corrupti laudantium minus
                            delectus, perspiciatis numquam doloribus labore excepturi! Recusandae voluptate fugiat quae
                            exercitationem corporis?
                        </p>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="mb-1 btn btn-primary btn-sm mr-2" data-toggle="modal"
                            data-target="#modalLihatLampiran">
                            <i class=" mdi mdi-eye mr-2"></i>Lampiran Foto
                        </button>
                        <p>
                            <span class="badge badge-success px-2">
                                <i class="mdi mdi-check-circle mr-2"></i>Disetujui
                            </span>
                        </p>
                    </div>
                    <div class="d-flex flex-column mt-2">
                        @hasanyrole('super-admin|guru-pembimbing')
                            <a href="#" class="btn btn-success rounded-pill w-100 mt-2">
                                <i class="mdi mdi-checkbox-marked-circle-outline mr-2"></i> Setujui Log Book
                            </a>
                        @endhasanyrole
                    </div>
                </div>
            </div>

            {{-- Modal Surat Magang --}}
            <div class="modal fade" id="modalLihatLampiran" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalTooltip" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle2">
                                Lampiran Magang
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <img src="{{ asset('surat-balasan/') }}" alt="....." width="auto" class="img-fluid">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End --}}
        </div>


        {{-- modal --}}
        <div class="modal fade" id="modalTambahLogBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLarge">Tambah Log Book Magang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Form Update Kelas -->
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">
                            <!-- Kode Kelas -->
                            <label class="text-dark font-weight-medium" for="deskripsi">Deskripsi Kegiatan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-format-align-justify"></i>
                                    </span>
                                </div>
                                <textarea name="deskripsi" id="deskripsi" cols="30" rows="4"
                                    class="form-control @error('deskripsi') is-invalid @enderror"
                                    placeholder="Berikan penjelasan mengenai kegiatan di tempat magang anda pada hari ini! (Max: 100 kata)" autofocus>{{ old('deskripsi') }}</textarea>

                                @error('deskripsi')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Nama Kelas -->
                            <label class="text-dark font-weight-medium" for="lampiran_foto">Lampirkan Foto kegiatan (Image:
                                JPEG,JPG,PNG)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-image"></i>
                                    </span>
                                </div>
                                <input type="file" name="lampiran_foto" id="lampiran_foto"
                                    value="{{ old('lampiran_foto') }}"
                                    class="form-control @error('lampiran_foto') is-invalid @enderror"
                                    placeholder="lampiran_foto" aria-label="lampiran_foto">
                                @error('lampiran_foto')
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

                            <button class="ladda-button btn btn-success btn-square btn-ladda" data-style="slide-left"
                                type="submit">
                                <span class="ladda-label"><i
                                        class="mdi mdi-checkbox-marked-outline mr-2"></i>Submit!</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
