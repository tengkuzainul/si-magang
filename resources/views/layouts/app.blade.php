<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!--- Layout tag head --->
@include('layouts.head')

<body>
    <!--- Sweetalert Package --->
    @include('sweetalert::alert')

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <!--- Layout tag navbar --->
            @include('layouts.navbar')

            <!--- Layout tag sidebar --->
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>

            <!-- layouts tag footer -->
            @include('layouts.footer')
        </div>
    </div>

    <!-- Scripts JS Layouts -->
    @include('layouts.js')

</body>

</html>
