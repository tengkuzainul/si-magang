@extends('layouts.app', ['title' => 'User Management'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>All Users</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">User Management</div>
                <div class="breadcrumb-item"><a href="{{ route('user.all') }}">All Users</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section-title">All Users Data</h2>

                <a href="{{ route('user.create') }}" class="btn btn-success rounded-pill px-3" data-toggle="tooltip"
                    title="Create Users"><i class="fas fa-plus-circle mr-2"></i>Create
                    User</a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>All Users</h4>
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
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email / Username</th>
                                            <th>Role</th>
                                            <th>Reset Password</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            class="custom-control-input" id="checkbox-{{ $user->id }}">
                                                        <label for="checkbox-{{ $user->id }}"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if (!$user->image)
                                                        <img alt="image"
                                                            src="{{ 'https://ui-avatars.com/api/?name=' . $user->name . '&background=000&color=f5f5f5&rounded=true' }}"
                                                            class="rounded-circle" width="35" data-toggle="tooltip"
                                                            title="{{ $user->name }}">
                                                    @else
                                                        <img alt="image"
                                                            src="{{ asset('image-profile/' . $user->image) }}"
                                                            class="rounded-circle" width="35" height="35"
                                                            data-toggle="tooltip" title="{{ $user->name }}">
                                                    @endif
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td class="d-flex flex-column">
                                                    <span>{{ $user->email }}</span>
                                                    <span>{{ $user->username }}</span>
                                                </td>
                                                <td>
                                                    <div class="badge badge-dark" style="text-transform: capitalize">
                                                        {{ $user->roles->first()->name }}</div>
                                                </td>
                                                <td><a href="#" class="btn btn-primary btn-sm"><i
                                                            class="fas fa-key mr-2"></i>Reset Password</a></td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ route('user.edit', $user->id) }}"
                                                            class="btn btn-info mr-2 btn-sm" data-toggle="tooltip"
                                                            title="{{ 'Edit ' . $user->name }}"><i
                                                                class="fas fa-edit"></i></a>

                                                        <a href="{{ route('user.destroy', $user->id) }}"
                                                            class="btn btn-danger btn-sm" data-confirm-delete="true"
                                                            data-toggle="tooltip" title="{{ 'Delete ' . $user->name }}"><i
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
