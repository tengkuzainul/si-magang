<script src="{{ asset('assets/dashboard/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
{{-- <script src="{{ asset('assets/dashboard/plugins/simplebar/simplebar.min.js') }}"></script> --}}

<script src='{{ asset('assets/dashboard/plugins/charts/Chart.min.js') }}'></script>
<script src='{{ asset('assets/dashboard/js/chart.js') }}'></script>

<script src='{{ asset('assets/dashboard/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}'></script>
<script src='{{ asset('assets/dashboard/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}'></script>
{{-- <script src='{{ asset('assets/dashboard/js/vector-map.js') }}'></script> --}}

<script src='{{ asset('assets/dashboard/plugins/daterangepicker/moment.min.js') }}'></script>
<script src='{{ asset('assets/dashboard/plugins/daterangepicker/daterangepicker.js') }}'></script>
<script src='{{ asset('assets/dashboard/js/date-range.js') }}'></script>
<script src='{{ asset('assets/dashboard/plugins/toastr/toastr.min.js') }}'></script>

<script src="{{ asset('assets/dashboard/js/sleek.js') }}"></script>
{{-- <link href="{{ asset('assets/dashboard/options/optionswitch.css') }}" rel="stylesheet"> --}}
{{-- <script src="{{ asset('assets/dashboard/options/optionswitcher.js') }}"></script> --}}

<script src='{{ asset('assets/dashboard/plugins/data-tables/jquery.datatables.min.js') }}'></script>
<script src='{{ asset('assets/dashboard/plugins/data-tables/datatables.bootstrap4.min.js') }}'></script>

<script src='{{ asset('assets/dashboard/plugins/data-tables/datatables.responsive.min.js') }}'></script>


<script src='{{ asset('assets/dashboard/plugins/ladda/spin.min.js') }}'></script>
<script src='{{ asset('assets/dashboard/plugins/ladda/ladda.min.js') }}'></script>

<script>
    Ladda.bind(".ladda-button", {
        timeout: 1000
    });

    /* 7.2. BIND PROGRESS BUTTONS AND SIMULATE LOADING PROGRESS */
    Ladda.bind(".progress-demo button", {
        callback: function(instance) {
            var progress = 0;
            var interval = setInterval(function() {
                progress = Math.min(progress + Math.random() * 0.1, 1);
                instance.setProgress(progress);

                if (progress === 1) {
                    instance.stop();
                    clearInterval(interval);
                }
            }, 200);
        }
    });
</script>
