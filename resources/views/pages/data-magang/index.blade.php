@extends('layouts.app', ['title' => 'Data Magang'])

@section('breadcrumb')
    <div class="breadcrumb-wrapper">
        <h1>Data Magang</h1>
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
                    <h2>Data Magang</h2>

                    @role('super-admin')
                        <a href="{{ route('magang.create') }}" class="btn btn-outline-primary btn-sm text-uppercase">
                            <i class=" mdi mdi-account-plus mr-1"></i>Add New Data
                        </a>
                    @endrole
                </div>

                <div class="card-body">
                    <div class="responsive-data-table">
                        <table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    @hasanyrole('super-admin|guru-pembimbing')
                                        <th>Nama Siswa</th>
                                    @endhasanyrole
                                    @hasanyrole('super-admin|siswa')
                                        <th>Nama Guru Pembimbing</th>
                                    @endhasanyrole
                                    <th>Tahun Magang | Periode</th>
                                    <th>Tempat Magang</th>
                                    <th>Lampiran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataMagangs as $dataMagang)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @hasanyrole('super-admin|guru-pembimbing')
                                            <td>{{ $dataMagang->siswa->name }}</td>
                                        @endhasanyrole
                                        @hasanyrole('super-admin|siswa')
                                            <td>{{ $dataMagang->guruPembimbing->name }}</td>
                                        @endhasanyrole
                                        <td>
                                            <div class="d-felex-flex-column g-2">
                                                <p class="mb-1">
                                                    {{ $dataMagang->tahunAjaran->tahun_magang }}
                                                </p>
                                                <p>
                                                    {{ date('d M Y', strtotime($dataMagang->tahunAjaran->tanggal_mulai)) . ' - ' . date('d M Y', strtotime($dataMagang->tahunAjaran->tanggal_selesai)) }}
                                                </p>
                                            </div>
                                        </td>
                                        <td>{{ $dataMagang->tempat_magang }}</td>
                                        <td>
                                            <div class="d-flex flex-column g-2">
                                                <button type="button" class="btn btn-dark btn-pill btn-sm mb-2"
                                                    data-toggle="modal"
                                                    data-target="#modalSuratMagang-{{ $dataMagang->id }}">
                                                    <i class="mdi mdi-eye mr-2"></i>Surat Magang
                                                </button>
                                                <button type="button" class="btn btn-dark btn-pill btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#modalSuratBalasan-{{ $dataMagang->id }}">
                                                    <i class="mdi mdi-eye mr-2"></i>Surat Balasan
                                                </button>
                                            </div>
                                        </td>

                                        {{-- Modal Surat Magang --}}
                                        <div class="modal fade" id="modalSuratMagang-{{ $dataMagang->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalTooltip" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle2">Surat Magang |
                                                            {{ $dataMagang->siswa->name }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <img src="{{ asset('surat-magang/' . $dataMagang->surat_magang) }}"
                                                            alt="{{ $dataMagang->surat_magang }}" width="auto"
                                                            class="img-fluid">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-pill"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End --}}

                                        {{-- Modal Surat Magang --}}
                                        <div class="modal fade" id="modalSuratBalasan-{{ $dataMagang->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalTooltip" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle2">Surat Balasan |
                                                            {{ $dataMagang->siswa->name }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <img src="{{ asset('surat-balasan/' . $dataMagang->surat_balasan) }}"
                                                            alt="{{ $dataMagang->surat_magang }}" width="auto"
                                                            class="img-fluid">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-pill"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End --}}

                                        <td>
                                            @role('super-admin')
                                                <div class="d-flex justify-content-center align-items-center g-2">
                                                    <a href="{{ route('magang.edit', $dataMagang->id) }}"
                                                        class="mb-1 btn btn-primary btn-sm mr-2">
                                                        <i class=" mdi mdi-pencil-box"></i></a>

                                                    <a href="{{ route('magang.destroy', $dataMagang->id) }}"
                                                        class="mb-1 btn btn-danger btn-sm" data-confirm-delete="true">
                                                        <i class=" mdi mdi-delete"></i></a>
                                                </div>
                                            @endrole

                                            <div class="d-flex flex-column mt-2">
                                                <a href="{{ route('magang.tambahLogbook', $dataMagang->id) }}"
                                                    class="btn btn-primary w-100 btn-pill">
                                                    @role('siswa')
                                                        <i class="mdi mdi-plus-circle mr-2"></i>Tambah Logbook
                                                    @endrole
                                                    @hasanyrole('super-admin|guru-pembimbing')
                                                        <i class="mdi mdi-eye-circle mr-2"></i>Lihat Logbook
                                                    @endhasanyrole
                                                </a>
                                            </div>
                                        </td>
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
