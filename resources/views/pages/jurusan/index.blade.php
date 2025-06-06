@extends('layouts.app', ['title' => 'Jurusan'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Jurusan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Master Data</div>
                <div class="breadcrumb-item"><a href="{{ route('jurusan.index') }}">Jurusan</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section-title">Jurusan Data</h2>

                <a href="{{ route('jurusan.create') }}" class="btn btn-success rounded-pill px-3" data-toggle="tooltip"
                    title="Create Jurusan"><i class="fas fa-plus-circle mr-2"></i>Create
                    Jurusan</a>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Jurusan</h4>
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
                                            <th>Kode Jurusan</th>
                                            <th>Nama Jurusan</th>
                                            <th>List Kelas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jurusans as $jurusan)
                                            <tr>
                                                <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            class="custom-control-input" id="checkbox-{{ $jurusan->id }}">
                                                        <label for="checkbox-{{ $jurusan->id }}"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="badge badge-primary" style="text-transform: capitalize">
                                                        {{ $jurusan->kd_jurusan }}
                                                    </div>
                                                </td>
                                                <td>{{ $jurusan->nama_jurusan }}</td>
                                                <td class="d-flex justify-content-start">
                                                    @foreach ($jurusan->kelas as $list)
                                                        <div class="badge badge-secondary mr-2"
                                                            style="text-transform: capitalize">
                                                            {{ $list->nama_kelas }}
                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ route('jurusan.edit', $jurusan->id) }}"
                                                            class="btn btn-info mr-2 btn-sm" data-toggle="tooltip"
                                                            title="{{ 'Edit ' . $jurusan->nama_jurusan }}"><i
                                                                class="fas fa-edit"></i></a>

                                                        <a href="{{ route('jurusan.destroy', $jurusan->id) }}"
                                                            class="btn btn-danger btn-sm" data-confirm-delete="true"
                                                            data-toggle="tooltip"
                                                            title="{{ 'Delete ' . $jurusan->nama_jurusan }}"><i
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
