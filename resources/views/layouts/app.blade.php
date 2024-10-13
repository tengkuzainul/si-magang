<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    @include('layouts.head')
</head>

<body class="header-fixed sidebar-static sidebar-light header-light" id="body">
    @include('sweetalert::alert')

    <script>
        NProgress.configure({
            showSpinner: false
        });
        NProgress.start();
    </script>

    {{-- <div id="toaster"></div> --}}

    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">
        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        @include('layouts.sidebar')


        <!-- ====================================
        ——— PAGE WRAPPER
        ===================================== -->
        <div class="page-wrapper">

            <!-- Header -->
            @include('layouts.header')


            <!-- ====================================
          ——— CONTENT WRAPPER
          ===================================== -->
            <div class="content-wrapper">
                <div class="content">
                    @yield('breadcrumb')

                    @yield('content')
                </div> <!-- End Content -->
            </div> <!-- End Content Wrapper -->


            <!-- Footer -->
            @include('layouts.footer')

        </div> <!-- End Page Wrapper -->
    </div> <!-- End Wrapper -->

    <!-- Javascript -->
    @include('layouts.js')
</body>

</html>
