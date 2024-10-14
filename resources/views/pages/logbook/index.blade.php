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
                <li class="breadcrumb-item">
                    <a href="{{ route('magang.index') }}">
                        Table Log Book Siswa
                    </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{ $magang->siswa->name }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row align-items-start">
        <div class="col-xl-12">
            @hasanyrole('super-admin|guru-pembimbing')
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="card-title">
                            <p class="text-dark font-weight-bold h4">Logbook Information</p>
                        </div>
                        <div class="card-content">
                            <ul class="text-dark font-weight-bold h6 list-group list-group-flush">
                                <li class="list-group-item">
                                    <span class="text-dark font-weight-normal">Nama Siswa :</span> {{ $magang->siswa->name }}
                                </li>
                                <li class="list-group-item">
                                    <span class="text-dark font-weight-normal">Tempat Magang :</span>
                                    {{ $magang->tempat_magang }}
                                </li>
                                <li class="list-group-item">
                                    <span class="text-dark font-weight-normal">Tempat Magang :</span>
                                    {{ $magang->tahunAjaran->tahun_magang }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endhasanyrole

            <form action="{{ route('logbook.selectTahun') }}" method="GET">
                <div
                    class="d-flex justify-content-{{ Auth::user()->roles == 'siswa' ? 'between' : 'end' }} align-items-center">
                    @role('siswa')
                        <div>
                            <label class="text-dark font-weight-medium" for="">Pilih Tahun Ajaran Magang</label>
                            <div class="input-group">
                                <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control">
                                    <option selected>--- PILIH TAHUN AJARAN ---</option>
                                    @foreach ($tahunAjaran as $tahun)
                                        <option value="{{ $tahun->id }}">
                                            {{ $tahun->kd_tahun_magang . ' | ' . $tahun->tahun_magang }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-group-append position-relative">
                                    <button class="btn btn-primary rounded" type="submit" name=""><i
                                            class="mdi mdi-search mr-2"></i>PILIH</button>
                                </div>
                            </div>
                        </div>
                    @endrole

                    @hasanyrole('super-admin|siswa')
                        <div>
                            <button type="button" class="mb-1 btn btn-primary mr-2 mt-2 float-end" data-toggle="modal"
                                data-target="#modalTambahLogBook">
                                <i class=" mdi mdi-plus-circle mr-2"></i>Log Book
                            </button>
                        </div>
                    @endhasanyrole
                </div>
            </form>
        </div>

        @forelse($magang->logbooks as $logbook)
            <div class="col-md-6 mb-3 mt-2">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-1 font-weight-bold text-dark">
                            {{ $logbook->created_at->format('d F Y') }}
                        </h4>
                        <hr class="border-dark">
                        <div class="card-content">
                            <p class="text-dark font-weight-medium text-justify">
                                {{ $logbook->deskripsi }}
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="mb-1 btn btn-primary btn-sm mr-2" data-toggle="modal"
                                data-target="#modalLihatLampiran{{ $logbook->id }}">
                                <i class="mdi mdi-eye mr-2"></i>Lampiran Foto
                            </button>
                            <p>
                                @if ($logbook->status == 'Disetujui')
                                    <span class="badge badge-success px-2">
                                        <i class="mdi mdi-check-circle mr-2"></i>Disetujui
                                    </span>
                                @else
                                    <span class="badge badge-warning px-2 text-dark">
                                        <i class="mdi mdi-clock mr-2 text-dark"></i>Menunggu Persetujuan
                                    </span>
                                @endif
                            </p>
                        </div>
                        <div class="d-flex flex-column mt-2">
                            @hasanyrole('super-admin|guru-pembimbing')
                                @if ($logbook->status != 'Disetujui')
                                    <a href="{{ route('logbook.ubahStatus', $logbook->id) }}"
                                        class="btn btn-success rounded-pill w-100 mt-2"
                                        onclick="event.preventDefault(); document.getElementById('setujui-logbook-{{ $logbook->id }}').submit();">
                                        <i class="mdi mdi-checkbox-marked-circle-outline mr-2"></i> Setujui Log Book
                                    </a>

                                    <form id="setujui-logbook-{{ $logbook->id }}"
                                        action="{{ route('logbook.ubahStatus', $logbook->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('PATCH')
                                    </form>
                                @endif
                            @endhasanyrole

                        </div>
                    </div>
                </div>

                {{-- Modal Lampiran --}}
                <div class="modal fade" id="modalLihatLampiran{{ $logbook->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="modalLihatLampiranLabel{{ $logbook->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLihatLampiranLabel{{ $logbook->id }}">
                                    Lampiran Magang
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('lampiran-foto-logbook/' . $logbook->lampiran_foto) }}"
                                    alt="Lampiran Foto" class="img-fluid">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Modal --}}
            </div>
        @empty
            <div class="col-md-12 mt-3">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-content">
                            <h1 class="text-dark text-center font-weight-bold">DATA LOG BOOK KOSONG.</h1>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse

        {{-- modal --}}
        <div class="modal fade" id="modalTambahLogBook" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLarge" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLarge">Tambah Log Book Magang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Form Update Kelas -->
                    <form action="{{ route('logbook.store', $magang->id) }}" method="POST"
                        enctype="multipart/form-data">
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
                            <label class="text-dark font-weight-medium" for="lampiran_foto">Lampirkan Foto kegiatan
                                (Image:
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
