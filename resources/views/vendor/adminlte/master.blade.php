<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'AdminLTE 3'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    @if(! config('adminlte.enabled_laravel_mix'))
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    @include('adminlte::plugins', ['type' => 'css'])

    @yield('adminlte_css_pre')
{{-- //css own --}}
    {{-- @stack('css') --}}
    <link rel="stylesheet" href="{{asset('data-table/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('multiselect/css/bootstrap-multiselect.css')}}">
    <link rel="stylesheet" href="{{asset('air-datepicker/css/datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('Ionicons/css/ionicons.min.css')}}">
{{-- //css own end --}}

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    @yield('adminlte_css')

    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> --}}
    @else
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
</head>
<body class="@yield('classes_body')" @yield('body_data') id="@yield('id')">

@yield('body')

@stack('modal')

@if(! config('adminlte.enabled_laravel_mix'))
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

{{-- //own JS --}}
    <script> console.log('hi');</script>
    <script src="{{asset('js/active.js')}}"></script>
    <script src="{{asset('js/vue.min.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('select2/js/select2.min.js')}}"></script>
    <script src="{{asset('data-table/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('data-table/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('multiselect/js/bootstrap-multiselect.js')}}"></script>
    <script src="{{asset('air-datepicker/js/datepicker.min.js')}}"></script>
    <script src="{{asset('air-datepicker/js/i18n/datepicker.en.js')}}"></script>
    <script src="{{asset('js/sweetalert2@9.js')}}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> --}}

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );

        // {
        //         "scrollY":"200px",
        //         "scrollCollapse": true
        //     }
    </script>
    @stack('script')
{{-- //own JS end --}}

@include('adminlte::plugins', ['type' => 'js'])

@yield('adminlte_js')
@else
<script src="{{ asset('js/app.js') }}"></script>
@endif
@include('sweetalert::alert')
</body>
</html>
