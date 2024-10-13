@extends('layouts.app', ['title' => 'User Manage'])

@section('breadcrumb')
    <div class="breadcrumb-wrapper">
        <h1>Dosen Pembimbing User</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <span class="mdi mdi-home"></span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    User Manage
                </li>
                <li class="breadcrumb-item" aria-current="page">Dosen Pembimbing User</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Data Siswa User</h2>

                    <a href="{{ route('user.create') }}" class="btn btn-outline-primary btn-sm text-uppercase">
                        <i class=" mdi mdi-account-plus mr-1"></i>Add New Data
                    </a>
                </div>

                <div class="card-body">
                    <div class="responsive-data-table">
                        <table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                    <th>Reset Password</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span
                                                class="mb-2 mr-2 badge badge-info rounded">{{ $user->roles->first()->name }}</span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm bg-primary text-white mb-3 mb-md-0"
                                                data-toggle="modal" data-target="#modalResetPassword-{{ $user->id }}">
                                                <i class=" mdi mdi-account-key mr-2"></i>Reset Password
                                            </button>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center g-2">
                                                <a href="#" class="mb-1 btn btn-primary btn-sm mr-2">
                                                    <i class=" mdi mdi-pencil-box"></i></a>

                                                <a href="#" class="mb-1 btn btn-danger btn-sm"
                                                    data-confirm-delete="true">
                                                    <i class=" mdi mdi-delete"></i></a>
                                            </div>
                                        </td>

                                        <div class="modal fade" id="modalResetPassword-{{ $user->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLarge">Reset Password</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <label class="text-dark font-weight-medium"
                                                                for="new_password">New
                                                                Password</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="mdi mdi-account-key"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="password" name="new_password" id="new_password"
                                                                    value=""
                                                                    class="form-control @error('new_password') is-invalid @enderror"
                                                                    placeholder="New Password" aria-label="New Password">
                                                            </div>

                                                            <label class="text-dark font-weight-medium"
                                                                for="password_confirmation">
                                                                Confirmation Password</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="mdi mdi-account-key"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="password" name="password_confirmation"
                                                                    id="password_confirmation" value=""
                                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                                    placeholder="Confirmation Password"
                                                                    aria-label="Confirmation Password">
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="reset" class="btn btn-danger rounded">
                                                                <i class="mdi mdi-replay mr-2"></i>Reset
                                                            </button>

                                                            <button type="submit" class="btn btn-primary rounded">
                                                                <i class="mdi mdi-checkbox-marked-outline mr-2"></i>Submit
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
