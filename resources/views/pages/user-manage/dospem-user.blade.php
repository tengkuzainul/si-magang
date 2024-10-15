@extends('layouts.app', ['title' => 'User Manage'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Guru Pembimbing Users</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">User Management</div>
                <div class="breadcrumb-item"><a href="{{ route('user.guru-pembimbing') }}">Guru Pembimbing Users</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Guru Pembimbing Users Data</h2>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Guru Pembimbing Users</h4>
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
                                            <th>Email</th>
                                            <th>Username (NUPTK)</th>
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
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->username }}</td>
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
