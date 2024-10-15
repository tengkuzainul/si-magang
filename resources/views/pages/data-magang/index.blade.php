@extends('layouts.app', ['title' => 'Data Magang'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Magang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('magang.index') }}">Data Magang</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section-title">Data Magang</h2>

                <a href="{{ route('magang.create') }}" class="btn btn-success rounded-pill px-3" data-toggle="tooltip"
                    title="Create Tahun Magang"><i class="fas fa-plus-circle mr-2"></i>Create
                    Data Magang</a>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Data Magang</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        data-checkbox-role="dad" class="custom-control-input"
                                                        id="checkbox-all">
                                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </th>
                                            @hasanyrole('super-admin|guru-pembimbing')
                                                <th>Nama Siswa</th>
                                                <th>Kelas</th>
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
                                                <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            class="custom-control-input"
                                                            id="checkbox-{{ $dataMagang->id }}">
                                                        <label for="checkbox-{{ $dataMagang->id }}"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                @hasanyrole('super-admin|guru-pembimbing')
                                                    <td>
                                                        {{ $dataMagang->siswa->name }}
                                                    </td>
                                                    <td>
                                                        {{ $dataMagang->siswa->kelas->nama_kelas ?? 'Belum Ada Kelas' }}
                                                    </td>
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
                                                    <a href="{{ route('magang.lihatSuratLampiranMagang', $dataMagang->id) }}"
                                                        class="btn btn-dark rounded mb-2"><i
                                                            class="fas fa-eye mr-2"></i>Lihat Lampiran</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ route('magang.edit', $dataMagang->id) }}"
                                                            class="btn btn-info mr-2 btn-sm" data-toggle="tooltip"
                                                            title="{{ 'Edit ' . $dataMagang->nama_kelas }}"><i
                                                                class="fas fa-edit"></i></a>

                                                        <a href="{{ route('magang.destroy', $dataMagang->id) }}"
                                                            class="btn btn-danger btn-sm" data-confirm-delete="true"
                                                            data-toggle="tooltip"
                                                            title="{{ 'Delete ' . $dataMagang->nama_kelas }}"><i
                                                                class="fas fa-trash"></i></a>
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
        </div>
    </section>
@endsection
