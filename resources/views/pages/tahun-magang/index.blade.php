@extends('layouts.app', ['title' => 'Tahun Ajaran Magang'])

@section('breadcrumb')
    <div class="breadcrumb-wrapper">
        <h1>Tahun Ajaran Magang</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <span class="mdi mdi-home"></span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    Tahun Ajaran Magang
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
                    <h2>Tahun Ajaran Magang</h2>

                    <a href="{{ route('tahun-magang.create') }}" class="btn btn-outline-primary btn-sm text-uppercase">
                        <i class=" mdi mdi-account-plus mr-1"></i>Add New Data
                    </a>
                </div>

                <div class="card-body">
                    <div class="responsive-data-table">
                        <table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Tahun Magang</th>
                                    <th>Tahun Ajaran Magang</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($magangs as $magang)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <span
                                                class="mb-2 mr-2 badge badge-info rounded">{{ $magang->kd_tahun_magang }}</span>
                                        </td>
                                        <td>{{ $magang->tahun_magang }}</td>
                                        <td>{{ date('d F Y', strtotime($magang->tanggal_mulai)) }}</td>
                                        <td>{{ date('d F Y', strtotime($magang->tanggal_selesai)) }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center g-2">
                                                <a href="{{ route('tahun-magang.edit', $magang->id) }}"
                                                    class="mb-1 btn btn-primary btn-sm mr-2">
                                                    <i class=" mdi mdi-pencil-box"></i></a>

                                                <a href="{{ route('tahun-magang.destroy', $magang->id) }}"
                                                    class="mb-1 btn btn-danger btn-sm" data-confirm-delete="true">
                                                    <i class=" mdi mdi-delete"></i></a>
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
