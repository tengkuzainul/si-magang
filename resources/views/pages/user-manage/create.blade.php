@extends('layouts.app', ['title' => 'User'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create Users</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">User Management</div>
                <div class="breadcrumb-item"><a href="{{ route('user.create') }}">Create Users</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section-title">Create Data</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Form Create User</h4>
                        </div>
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-sm-2">
                                        <!--Avatar-->
                                        <div class="d-flex justify-content-center mb-4">
                                            <img id="selectedAvatar"
                                                src="{{ 'https://ui-avatars.com/api/?name=' . Auth::user()->name . '&background=000&color=f5f5f5&rounded=true' }}"
                                                class="rounded-circle" alt="{{ Auth::user()->image }}" width="100"
                                                height="100" />
                                        </div>
                                        <div class="d-flex justify-content-center mb-2 mt-0">
                                            <div data-mdb-ripple-init class="btn btn-primary btn-rounded btn-sm">
                                                <label class="form-label text-white m-1" for="customFile2"><i
                                                        class="fas fa-upload mr-2"></i>Choose
                                                    file</label>
                                                <input type="file" name="image" class="form-control d-none"
                                                    id="customFile2"
                                                    onchange="displaySelectedImage(event, 'selectedAvatar')" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="fullname">FullName</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="name" id="fullname"
                                                    value="{{ old('fullname') }}"
                                                    class="form-control @error('fullname') is-invalid @enderror"
                                                    placeholder="FullName" aria-label="FullName" autofocus>

                                                @error('fullname')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="kelas">Select Kelas</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-school"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control @error('kelas')  is-invalid  @enderror"
                                                    id="kelas" name="kelas_id">
                                                    <option selected disabled>--- Select ---</option>
                                                    @foreach ($kelas as $data)
                                                        <option value="{{ $data->id }}"
                                                            {{ old('kelas_id') == $data->id ? 'selected' : '' }}>
                                                            {{ $data->nama_kelas }}</option>
                                                    @endforeach
                                                </select>

                                                @error('role')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="username">NISN/NUPTK</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="username" id="username"
                                                    value="{{ old('username') }}"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    placeholder="Username" aria-label="Username">

                                                @error('username')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="email">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-envelope"></i>
                                                    </span>
                                                </div>
                                                <input type="email" name="email" id="email"
                                                    value="{{ old('email') }}"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Email" aria-label="Email">

                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="role">Select Role</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-user-shield"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control @error('role')  is-invalid  @enderror"
                                                    id="role" name="role">
                                                    <option selected disabled>--- Select ---</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}"
                                                            {{ old('role') == $role->name ? 'selected' : '' }}>
                                                            {{ $role->name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('role')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium" for="password">Password</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-lock"></i>
                                                    </span>
                                                </div>
                                                <input type="password" name="password" id="password"
                                                    value="{{ old('password') }}"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Password" aria-label="Password">

                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="text-dark font-weight-medium"
                                                for="password_confirmation">Password
                                                Confirmation</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-lock"></i>
                                                    </span>
                                                </div>
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation" value="{{ old('password_confirmation') }}"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    placeholder="Password Confirmation" aria-label="Password Confirmation"
                                                    data-indicator="pwindicator">

                                                @error('password_confirmation')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="reset" class="btn btn-danger rounded">
                                        <i class="fas fa-undo mr-2"></i>Reset
                                    </button>

                                    <button type="submit" class="btn btn-primary rounded">
                                        <i class="fas fa-check-circle mr-2"></i>Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function displaySelectedImage(event, elementId) {
            const selectedImage = document.getElementById(elementId);
            const fileInput = event.target;

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    selectedImage.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
@endsection
