<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="SISTEM INFORMASI MAGANG (SIMAG) SMK 6 PEKANBARU">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIMAG SMK 6 PEKANBARU - Sign In</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
        rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="{{ asset('assets/dashboard/css/sleek.css') }}" />

    <!-- FAVICON -->
    <link href="{{ asset('assets/dashboard/img/favicon.png') }}" rel="shortcut icon" />

    <script src="{{ asset('assets/dashboard/plugins/nprogress/nprogress.js') }}"></script>
</head>

<body class="" id="body"
    style="background-image: url({{ asset('assets/dashboard/img/Bachground-login.jpg') }}); background-size: cover; background-repeat: no-repeat; background-position: top center;">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary">
                        <div class="d-flex justify-content-start align-items-center">
                            <img src="{{ asset('assets/dashboard/img/logo-smk-6.png') }}" alt="logo"
                                class="brand-icon" width="60">
                            <a href="{{ url('/') }}" class="text-white font-weight-bold ml-2">
                                SISTEM INFORMASI MAGANG SMK 6 PEKANBARU
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-5">
                        <h4 class="text-dark mb-5">Sign In</h4>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-12 mb-4">
                                    <input type="text" id="username" name="username" value="{{ old('username') }}"
                                        class="form-control input-lg @error('username') is-invalid @enderror"
                                        aria-describedby="emailHelp" placeholder="Username / Email" autofocus>


                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <span class="mt-2 d-block">Username berupa NISN Siswa Atau NUPTK Guru.</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12 ">
                                    <input type="password" name="password" id="password"
                                        class="form-control input-lg @error('password') is-invalid @enderror"
                                        placeholder="Password">

                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex my-2 justify-content-between">
                                        <div class="d-inline-block mr-3">
                                            <label class="control control-checkbox">Remember me
                                                <input type="checkbox" ame="remember" id="remember"
                                                    {{ old('remember') ? 'checked' : '' }} />
                                                <div class="control-indicator"></div>
                                            </label>
                                        </div>

                                        {{-- <p><a class="text-blue" href="#">Forgot Your Password?</a></p> --}}
                                    </div>

                                    <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Sign
                                        In</button>

                                    {{-- <p>Don't have an account yet ?
                                        <a class="text-blue" href="sign-up.html">Sign Up</a>
                                    </p> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="{{ asset('assets/dashboard/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/sleek.js') }}"></script>
    {{-- <link href="{{ asset('assets/dashboard/options/optionswitch.css') }}" rel="stylesheet"> --}}
    {{-- <script src="{{ asset('assets/dashboard/options/optionswitcher.js') }}"></script> --}}
</body>

</html>
