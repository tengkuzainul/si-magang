<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="DASHBOARD SISTEM INFORMASI MAGANG SMK 6 PEKANBARU">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- theme meta -->
<meta name="theme-name" content="sleek" />

<title>SIMAG SMK 6 PEKANBARU | {{ $title }}</title>

<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
    rel="stylesheet" />

<link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

<!-- PLUGINS CSS STYLE -->
{{-- <link href="{{ asset('assets/dashboard/plugins/simplebar/simplebar.css') }}" rel="stylesheet" /> --}}
<link href="{{ asset('assets/dashboard/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />

<!-- No Extra plugin used -->
<link href='{{ asset('assets/dashboard/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}' rel='stylesheet'>
<link href='{{ asset('assets/dashboard/plugins/daterangepicker/daterangepicker.css') }}' rel='stylesheet'>

<link href='{{ asset('assets/dashboard/plugins/toastr/toastr.min.css') }}' rel='stylesheet'>

<!-- SLEEK CSS -->
<link id="sleek-css" rel="stylesheet" href="{{ asset('assets/dashboard/css/sleek.css') }}" />

<!-- FAVICON -->
<link href="{{ asset('assets/dashboard/img/favicon.png') }}" rel="shortcut icon" />

<script src="{{ asset('assets/dashboard/plugins/nprogress/nprogress.js') }}"></script>

<link href='{{ asset('assets/dashboard/plugins/data-tables/datatables.bootstrap4.min.css') }}' rel='stylesheet'>
<link href='{{ asset('assets/dashboard/plugins/data-tables/responsive.datatables.min.css') }}' rel='stylesheet'>
<link href='{{ asset('assets/dashboard/plugins/ladda/ladda.min.css') }}' rel='stylesheet'>
