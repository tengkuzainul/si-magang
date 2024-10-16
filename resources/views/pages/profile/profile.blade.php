@extends('layouts.app', ['title' => 'Edit Profile'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Profile</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Hi, {{ Auth::user()->name }}!</h2>
            <p class="section-lead">
                Welcome to SISMA SMK 6 PEKANBARU.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form method="POST" action="{{ route('profile.update') }}" class="needs-validation" novalidate=""
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12 col-12">
                                        <div class="d-flex justify-content-center mb-4">
                                            @if (Auth::user()->image)
                                                <img id="selectedProfile"
                                                    src="{{ asset('image-profile/' . Auth::user()->image) }}"
                                                    class="rounded-circle" alt="image" width="100" height="100" />
                                            @else
                                                <img id="selectedProfile"
                                                    src="{{ 'https://ui-avatars.com/api/?name=' . Auth::user()->name . '&background=000&color=f5f5f5&rounded=true' }}"
                                                    class="rounded-circle" alt="image" width="100" height="100" />
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-center mb-2 mt-0">
                                            <div data-mdb-ripple-init class="btn btn-primary btn-rounded btn-sm">
                                                <label class="form-label text-white m-1" for="customFile2"><i
                                                        class="fas fa-upload mr-2"></i>Choose
                                                    file</label>
                                                <input type="file" name="image" class="form-control d-none"
                                                    id="customFile2"
                                                    onchange="displaySelectedImage(event, 'selectedProfile')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', Auth::user()->name) }}" required="">

                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        @hasanyrole('guru-pembimbing|siswa')
                                            <label
                                                for="username">{{ Auth::user()->roles->first()->name == 'siswa' ? 'NISN' : 'NUPTK' }}</label>
                                        @endhasanyrole
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username"
                                            class="form-control @error('username') is-invalid @enderror"
                                            value="{{ old('username', Auth::user()->username) }}" required="">

                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 col-12">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', Auth::user()->email) }}" required="">

                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror" value="">

                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label for="password_confirmation">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            value="">

                                        @error('password_confirmation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-success btn-rounded px-3" type="submit"><i
                                        class="fas fa-check-circle mr-2"></i>Save Changes</button>
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
