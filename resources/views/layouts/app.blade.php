<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="{{ url('/assets/img/favicon.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title') </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="{{ url('/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ url('/assets/css/sliders.css') }}" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="{{ url('/assets/css/material-dashboard.css') }}" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ url('/assets/css/demo.css') }}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="{{ url('/assets/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />
    @stack('css')
</head>

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
            @include('layouts.navbar')
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            {{-- @include('layouts.footer') --}}
        </div>
    </div>
    @stack('float')
</body>
<!--   Core JS Files   -->
<script src="{{ url('/assets/js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript">
</script>
<!-- Forms Validations Plugin -->
<script src="{{ url('/assets/js/jquery.validate.min.js') }}"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="{{ url('/assets/js/moment.min.js') }}"></script>
<!--  Charts Plugin -->
<script src="{{ url('/assets/js/chartist.min.js') }}"></script>
<!--  Plugin for the Wizard -->
<script src="{{ url('/assets/js/jquery.bootstrap-wizard.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ url('/assets/js/bootstrap-notify.js') }}"></script>
<!--   Sharrre Library    -->
<script src="{{ url('/assets/js/jquery.sharrre.js') }}"></script>
<!-- DateTimePicker Plugin -->
<script src="{{ url('/assets/js/bootstrap-datetimepicker.js') }}"></script>
<!-- Vector Map plugin -->
<script src="{{ url('/assets/js/jquery-jvectormap.js') }}"></script>
<!-- Sliders Plugin -->
<script src="{{ url('/assets/js/nouislider.min.js') }}"></script>
<!--  Google Maps Plugin    -->
<!--<script src="../assets/js/jquery.select-bootstrap.js"></script>-->
<!-- Select Plugin -->
<script src="{{ url('/assets/js/jquery.select-bootstrap.js') }}"></script>
<!--  DataTables.net Plugin    -->
<script src="{{ url('/assets/js/jquery.datatables.js') }}"></script>
<!-- Sweet Alert 2 plugin -->
<script src="{{ url('/assets/js/sweetalert2.js') }}"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ url('/assets/js/jasny-bootstrap.min.js') }}"></script>
<!--  Full Calendar Plugin    -->
<script src="{{ url('/assets/js/fullcalendar.min.js') }}"></script>
<!-- TagsInput Plugin -->
<script src="{{ url('/assets/js/jquery.tagsinput.js') }}"></script>
<!-- Material Dashboard javascript methods -->
<script src="{{ url('/assets/js/material-dashboard.js') }}"></script>

<!-- Material Dashboard DEMO methods, don't include it in your project! -->
{{-- <script src="{{ url('/assets/js/demo.js') }}"></script> --}}
{{-- <script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.initVectorMap();
    });
</script> --}}
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });

        var table = $('#datatables').DataTable();

        $('.card .material-datatables label').addClass('form-group');
    });

</script>
{{-- <script type="text/javascript">
    $(document).ready(function () {
        md.initSliders()
        demo.initFormExtendedDatetimepickers();
    });

</script> --}}
@stack('script')
</html>
