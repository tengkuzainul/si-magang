@extends('layouts.app', ['title' => 'User Manage Create'])

@section('breadcrumb')
    <div class="breadcrumb-wrapper">
        <h1>Create User</h1>
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
                <li class="breadcrumb-item" aria-current="page">Create User</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Create User</h2>
                </div>

                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <label class="text-dark font-weight-medium" for="fullname">FullName</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-account"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="fullname" id="fullname" value="{{ old('fullname') }}"
                                        class="form-control @error('fullname') is-invalid @enderror" placeholder="FullName"
                                        aria-label="FullName" autofocus>

                                    @error('fullname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="text-dark font-weight-medium" for="username">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-account"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="username" id="username" value="{{ old('username') }}"
                                        class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                                        aria-label="Username">

                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="text-dark font-weight-medium" for="email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-email"></i>
                                        </span>
                                    </div>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                        aria-label="Email">

                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="text-dark font-weight-medium" for="role">Select Role</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-security"></i>
                                        </span>
                                    </div>
                                    <select class="form-control @error('role')  is-invalid  @enderror" id="role">
                                        <option selected disabled>--- Select ---</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="text-dark font-weight-medium" for="password">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-key"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="password" value="{{ old('password') }}"
                                        class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                        aria-label="Password">

                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="text-dark font-weight-medium" for="password_confirmation">Password
                                    Confirmation</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-key"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        value="{{ old('password_confirmation') }}"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Password Confirmation" aria-label="Password Confirmation">

                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="reset" class="btn btn-danger rounded">
                                        <i class="mdi mdi-replay mr-2"></i>Reset
                                    </button>

                                    <button type="submit" class="btn btn-primary rounded">
                                        <i class="mdi mdi-checkbox-marked-outline mr-2"></i>Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
