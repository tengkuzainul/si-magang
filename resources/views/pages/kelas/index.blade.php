@extends('layouts.app', ['title' => 'Kelas'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kelas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Master Data</div>
                <div class="breadcrumb-item"><a href="{{ route('kelas.index') }}">Kelas</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section-title">Kelas Data</h2>

                <a href="{{ route('kelas.create') }}" class="btn btn-success rounded-pill px-3" data-toggle="tooltip"
                    title="Create Kelas"><i class="fas fa-plus-circle mr-2"></i>Create
                    Kelas</a>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Kelas</h4>
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
                                            <th>Kode Kelas</th>
                                            <th>Nama Kelas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kelas as $kelasId)
                                            <tr>
                                                <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            class="custom-control-input" id="checkbox-{{ $kelasId->id }}">
                                                        <label for="checkbox-{{ $kelasId->id }}"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="badge badge-primary" style="text-transform: capitalize">
                                                        {{ $kelasId->kd_kelas }}
                                                    </div>
                                                </td>
                                                <td>{{ $kelasId->nama_kelas }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ route('kelas.edit', $kelasId->id) }}"
                                                            class="btn btn-info mr-2 btn-sm" data-toggle="tooltip"
                                                            title="{{ 'Edit ' . $kelasId->nama_kelas }}"><i
                                                                class="fas fa-edit"></i></a>

                                                        <a href="{{ route('kelas.destroy', $kelasId->id) }}"
                                                            class="btn btn-danger btn-sm" data-confirm-delete="true"
                                                            data-toggle="tooltip"
                                                            title="{{ 'Delete ' . $kelasId->nama_kelas }}"><i
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
