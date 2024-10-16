@extends('layouts.app', ['title' => 'Tahun Magang'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tahun Magang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Master Data</div>
                <div class="breadcrumb-item"><a href="{{ route('tahun-magang.index') }}">Tahun Magang</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section-title">Tahun Magang Data</h2>

                <a href="{{ route('tahun-magang.create') }}" class="btn btn-success rounded-pill px-3" data-toggle="tooltip"
                    title="Create Tahun Magang"><i class="fas fa-plus-circle mr-2"></i>Create
                    Tahun Magang</a>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Tahun Magang</h4>
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
                                            <th>Kode Tahun Magang</th>
                                            <th>Tahun Ajaran Magang</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Status Logbook</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($magangs as $magang)
                                            <tr>
                                                <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            class="custom-control-input" id="checkbox-{{ $magang->id }}">
                                                        <label for="checkbox-{{ $magang->id }}"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="badge badge-dark" style="text-transform: capitalize">
                                                        {{ $magang->kd_tahun_magang }}
                                                    </div>
                                                </td>
                                                <td>{{ $magang->tahun_magang }}</td>
                                                <td>{{ date('d F Y', strtotime($magang->tanggal_mulai)) }}</td>
                                                <td>{{ date('d F Y', strtotime($magang->tanggal_selesai)) }}</td>
                                                <td class="d-flex flex-column">
                                                    <div class="badge badge-{{ $magang->status_logbook != 'Aktif' ? 'danger' : 'success' }} mb-2"
                                                        style="text-transform: capitalize">
                                                        {{ $magang->status_logbook }}
                                                    </div>

                                                    <a href="#"
                                                        class="btn btn-{{ $magang->status_logbook != 'Aktif' ? 'success' : 'danger' }} btn-rounded btn-sm"
                                                        onclick="event.preventDefault(); document.getElementById('changeStatusLogbook-{{ $magang->id }}').submit();">
                                                        <i
                                                            class="fas fa-{{ $magang->status_logbook != 'Aktif' ? 'check-circle' : 'times-circle' }} mr-3"></i>
                                                        {{ $magang->status_logbook != 'Aktif' ? 'Aktifkan Logbook' : 'Tutup Logbook' }}
                                                    </a>

                                                    <form action="{{ route('tahun-magang.ubahStatus', $magang->id) }}"
                                                        id="changeStatusLogbook-{{ $magang->id }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                    </form>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ route('tahun-magang.edit', $magang->id) }}"
                                                            class="btn btn-info mr-2 btn-sm" data-toggle="tooltip"
                                                            title="{{ 'Edit ' . $magang->nama_kelas }}"><i
                                                                class="fas fa-edit"></i></a>

                                                        <a href="{{ route('tahun-magang.destroy', $magang->id) }}"
                                                            class="btn btn-danger btn-sm" data-confirm-delete="true"
                                                            data-toggle="tooltip"
                                                            title="{{ 'Delete ' . $magang->nama_kelas }}"><i
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
