<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>
    {{-- <title>{{ getConfigContent()->name }}</title> --}}
    {{-- css links --}}
    @include('backend.includes._header_links')
    @stack('custom-css')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- wrapper -->
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>
        @include('backend.includes._header')
        @include('backend.includes._sidebar')
        @yield('content')
        @include('backend.includes._footer')
       
    </div>
    <!-- ./wrapper -->

    {{-- js and jquery links --}}
    @include('backend.includes._footer_links')
    @stack('custom-js')
</body>
</html>
