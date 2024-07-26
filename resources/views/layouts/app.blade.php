<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CBFSU</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <!-- Scripts -->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('assets/css/app.css') !!}"/>

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <!-- Scripts -->

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    <script src="{!! asset('assets/js/app.js') !!}?v=11"></script>
    <script src="{!! asset('assets/js/mws_datatable.js') !!}?v=11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        body {
            font-size: .875rem;
        }

        .feather {
            width: 16px;
            height: 16px;
            vertical-align: text-bottom;
        }

        /*
         * Sidebar
         */

        .sidebar {
            position: fixed;
            top: 0;
            /* rtl:raw:
            right: 0;
            */
            bottom: 0;
            /* rtl:remove */
            left: 0;
            z-index: 100; /* Behind the navbar */
            /*padding: 48px 0 0; !* Height of navbar *!*/
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        @media (max-width: 767.98px) {
            .sidebar {
                top: 5rem;
            }
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }

        .sidebar .nav-link .feather {
            margin-right: 4px;
            color: #727272;
        }

        .sidebar .nav-link.active {
            color: #2470dc;
        }

        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
            color: inherit;
        }

        .sidebar-heading {
            font-size: .75rem;
            text-transform: uppercase;
        }

        /*
         * Navbar
         */

        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: 1rem;
            background-color: rgba(0, 0, 0, .25);
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }

        .navbar .navbar-toggler {
            top: .25rem;
            right: 1rem;
        }

        .navbar .form-control {
            padding: .75rem 1rem;
            border-width: 0;
            border-radius: 0;
        }

        .form-control-dark {
            color: #fff;
            background-color: rgba(255, 255, 255, .1);
            border-color: rgba(255, 255, 255, .1);

        }

        .form-control-dark:focus {
            border-color: transparent;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
        }


        .mws-dropdown button.btn {
            color: #000 !important;
        }
    </style>
    <script>
        window.mwsIndex = 1;
        console.log(window.mwsIndex);
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .flex-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dropbtn {
            background-color: black;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: black;
        }

        .FixedHeightContainer {
            float: right;
            height: 230px;
            width: 300px;
            padding: 3px;
            background: white;
        }

        .scroller {
            height: 224px;
            overflow: auto;
            background: #fff;
        }

        .page-title {
            font-size: 18.43px;
            font-style: normal;
            font-weight: 600;
            color: #37394F;
        }

        .navItems {
            justify-content: center;
            align-items: center;
        }

    </style>
    @stack('style')

</head>

<body>
<div class="container-fluid openSidebar">
    <div class="sticky-header sideBarButton ">
        <button class="btn btn-sm d-flex m-auto onOpenArrow">&lsaquo;</button>
        <button class="btn btn-sm d-flex m-auto onHideArrow">&rsaquo;</button>
    </div>
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light collapse pl-0 pr-0">
            <div class="mws-sticky-sidebar">
                @include('layouts.sidebar')
            </div>
        </nav>
        <main class="ColumnWidth col-md-9 ms-sm-auto col-lg-10 mt-0 pr-0 pl-0">
            @include('layouts.navigation',['pageButton'=>$pageButton??'','title'=>$title??''])
            <div class="card mws-main-wrapper mt-2 ml-2 mr-2 mb-2 border-0" style="border-radius: 0">
                <div class="card-header mws-main-header">
                    @if (isset($header))
                        {{ $header }}
                    @endif
                </div>
                <div class="card-body mws-main-body">
                    {{ $slot }}
                </div>

                {{--   @if(!empty(session()->get('login_success')))
                       <div class="alert alert-danger">{!! session()->get('login_success') !!}</div>
                   @endif--}}
            </div>
        </main>
    </div>
</div>
<div class="mws-html-dropdown"></div>
<div id="default_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" class="modal" style="" aria-hidden="true"></div>

@stack('scripts')
@if(!empty(session()->get('login_success')))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Display SweetAlert on page load
        var valuetarget_user = @json($result);
        var valueuser = @json($user);

        if (valuetarget_user == 0 && (valueuser['role_id'] == '2' || valueuser['role_id'] == '4')) {

            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Please!',
                    text: 'Set Target!',
                    icon: 'warning',
                    confirmButtonText: 'Okay'
                });
            });
        }

    </script>
@endif

</body>
</html>




















{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}
{{--    <title> Credit Based Financial Services Unit </title>--}}

{{--    --}}{{--        {!!  !!}--}}
{{--    <!-- Fonts -->--}}
{{--    <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--    <!-- Scripts -->--}}
{{--    <link rel="stylesheet" href="{!! asset('assets/css/app.css') !!}"/>--}}
{{--    <script src="{!! asset('assets/js/app.js') !!}?v=11"></script>--}}

{{--    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>--}}
{{--    <!-- Scripts -->--}}
{{--    --}}{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}
{{--    --}}{{--        <link rel="stylesheet" href="{!! asset('assets/css/contract.css') !!}"/>--}}
{{--    --}}{{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>--}}
{{--     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>--}}
{{--     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>--}}
{{--    --}}{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}
{{--    <style>--}}
{{--        body {--}}
{{--            font-size: .875rem;--}}
{{--        }--}}

{{--        .feather {--}}
{{--            width: 16px;--}}
{{--            height: 16px;--}}
{{--            vertical-align: text-bottom;--}}
{{--        }--}}

{{--        /*--}}
{{--         * Sidebar--}}
{{--         */--}}

{{--        .sidebar {--}}
{{--            position: fixed;--}}
{{--            top: 0;--}}
{{--            /* rtl:raw:--}}
{{--            right: 0;--}}
{{--            */--}}
{{--            bottom: 0;--}}
{{--            /* rtl:remove */--}}
{{--            left: 0;--}}
{{--            z-index: 100; /* Behind the navbar */--}}
{{--            padding: 48px 0 0; /* Height of navbar */--}}
{{--            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);--}}
{{--        }--}}

{{--        @media (max-width: 767.98px) {--}}
{{--            .sidebar {--}}
{{--                top: 5rem;--}}
{{--            }--}}
{{--        }--}}

{{--        .sidebar-sticky {--}}
{{--            position: relative;--}}
{{--            top: 0;--}}
{{--            height: calc(100vh - 48px);--}}
{{--            padding-top: .5rem;--}}
{{--            overflow-x: hidden;--}}
{{--            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */--}}
{{--        }--}}

{{--        .sidebar .nav-link {--}}
{{--            font-weight: 500;--}}
{{--            color: #333;--}}
{{--        }--}}

{{--        .sidebar .nav-link .feather {--}}
{{--            margin-right: 4px;--}}
{{--            color: #727272;--}}
{{--        }--}}

{{--        .sidebar .nav-link.active {--}}
{{--            color: #2470dc;--}}
{{--        }--}}

{{--        .sidebar .nav-link:hover .feather,--}}
{{--        .sidebar .nav-link.active .feather {--}}
{{--            color: inherit;--}}
{{--        }--}}

{{--        .sidebar-heading {--}}
{{--            font-size: .75rem;--}}
{{--            text-transform: uppercase;--}}
{{--        }--}}

{{--        /*--}}
{{--         * Navbar--}}
{{--         */--}}

{{--        .navbar-brand {--}}
{{--            padding-top: .75rem;--}}
{{--            padding-bottom: .75rem;--}}
{{--            font-size: 1rem;--}}
{{--            background-color: rgba(0, 0, 0, .25);--}}
{{--            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);--}}
{{--        }--}}

{{--        .navbar .navbar-toggler {--}}
{{--            top: .25rem;--}}
{{--            right: 1rem;--}}
{{--        }--}}

{{--        .navbar .form-control {--}}
{{--            padding: .75rem 1rem;--}}
{{--            border-width: 0;--}}
{{--            border-radius: 0;--}}
{{--        }--}}

{{--        .form-control-dark {--}}
{{--            color: #fff;--}}
{{--            background-color: rgba(255, 255, 255, .1);--}}
{{--            border-color: rgba(255, 255, 255, .1);--}}

{{--        }--}}

{{--        .form-control-dark:focus {--}}
{{--            border-color: transparent;--}}
{{--            box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);--}}
{{--        }--}}


{{--        .mws-dropdown button.btn {--}}
{{--            color: #000 !important;--}}
{{--        }--}}
{{--    </style>--}}
{{--    <script>--}}
{{--        window.mwsIndex = 1;--}}
{{--        console.log(window.mwsIndex);--}}
{{--    </script>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}
{{--    <style>--}}
{{--        .flex-container {--}}
{{--            display: flex;--}}
{{--            justify-content: space-between;--}}
{{--            align-items: center;--}}
{{--        }--}}

{{--        .dropbtn {--}}
{{--            background-color: black;--}}
{{--            color: white;--}}
{{--            padding: 16px;--}}
{{--            font-size: 16px;--}}
{{--            border: none;--}}
{{--        }--}}

{{--        .dropdown {--}}
{{--            position: relative;--}}
{{--            display: inline-block;--}}
{{--        }--}}

{{--        .dropdown-content {--}}
{{--            display: none;--}}
{{--            position: absolute;--}}
{{--            background-color: #f1f1f1;--}}
{{--            min-width: 160px;--}}
{{--            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);--}}
{{--            z-index: 1;--}}
{{--        }--}}

{{--        .dropdown-content a {--}}
{{--            color: black;--}}
{{--            padding: 12px 16px;--}}
{{--            text-decoration: none;--}}
{{--            display: block;--}}
{{--        }--}}

{{--        .dropdown-content a:hover {--}}
{{--            background-color: #ddd;--}}
{{--        }--}}

{{--        .dropdown:hover .dropdown-content {--}}
{{--            display: block;--}}
{{--        }--}}

{{--        .dropdown:hover .dropbtn {--}}
{{--            background-color: black;--}}
{{--        }--}}

{{--        .FixedHeightContainer {--}}
{{--            float: right;--}}
{{--            height: 230px;--}}
{{--            width: 300px;--}}
{{--            padding: 3px;--}}
{{--            background: white;--}}
{{--        }--}}

{{--        .scroller {--}}
{{--            height: 224px;--}}
{{--            overflow: auto;--}}
{{--            background: #fff;--}}
{{--        }--}}

{{--        .page-title {--}}
{{--            font-size: 22.43px;--}}
{{--            font-style: normal;--}}
{{--            font-weight: 600;--}}
{{--            color: #37394F;--}}
{{--        }--}}

{{--        .navItems {--}}
{{--            justify-content: center;--}}
{{--            align-items: center;--}}
{{--        }--}}

{{--    </style>--}}
{{--    @stack('style')--}}

{{--</head>--}}

{{--<body>--}}
{{--<div class="container-fluid openSidebar">--}}
{{--    <div class="sticky-header sideBarButton ">--}}
{{--        <button class="btn btn-sm d-flex m-auto onOpenArrow">&lsaquo;</button>--}}
{{--        <button class="btn btn-sm d-flex m-auto onHideArrow">&rsaquo;</button>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light collapse pl-0 pr-0">--}}
{{--            <div class="mws-sticky-sidebar">--}}
{{--                @include('layouts.sidebar')--}}
{{--            </div>--}}
{{--        </nav>--}}
{{--        <main class="ColumnWidth col-md-9 ms-sm-auto col-lg-10 mt-0 pr-0 pl-0">--}}
{{--            @include('layouts.navigation',['pageButton'=>$pageButton??'','title'=>$title??''])--}}
{{--            <div class="card mws-main-wrapper mt-2 ml-2 mr-2 mb-2 border-0" style="border-radius: 0">--}}
{{--                <div class="card-header mws-main-header">--}}
{{--                    @if (isset($header))--}}
{{--                        {{ $header }}--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                <div class="card-body mws-main-body">--}}
{{--                    {{ $slot }}--}}
{{--                </div>--}}

{{--                --}}{{--   @if(!empty(session()->get('login_success')))--}}
{{--                       <div class="alert alert-danger">{!! session()->get('login_success') !!}</div>--}}
{{--                   @endif--}}
{{--            </div>--}}
{{--        </main>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="mws-html-dropdown"></div>--}}
{{--<div id="default_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"--}}
{{--     aria-labelledby="staticBackdropLabel" class="modal" style="" aria-hidden="true"></div>--}}

{{--@stack('scripts')--}}
{{--@if(!empty(session()->get('login_success')))--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}

{{--    <script>--}}
{{--        // Display SweetAlert on page load--}}
{{--        var valuetarget_user = @json($result);--}}
{{--        var valueuser = @json($user);--}}

{{--        if (valuetarget_user == 0 && (valueuser['role_id'] == '2' || valueuser['role_id'] == '4')) {--}}

{{--            document.addEventListener('DOMContentLoaded', function () {--}}
{{--                Swal.fire({--}}
{{--                    title: 'Please!',--}}
{{--                    text: 'Set Target!',--}}
{{--                    icon: 'warning',--}}
{{--                    confirmButtonText: 'Okay'--}}
{{--                });--}}
{{--            });--}}
{{--        }--}}

{{--    </script>--}}
{{--@endif--}}

{{--</body>--}}
{{--</html>--}}

