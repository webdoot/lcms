<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="WEBDOOT">

    <title> @yield('page_title') | LCMS </title>

    <link rel="icon" href="{{ asset('vendor/lcms/favicon.png') }}">

    {{-- Global stylesheets --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/lcms/css/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/lcms/css/all.min.css')}}" rel="stylesheet" type="text/css">

    {{--   Core JS files --}}
    <script src="{{ asset('vendor/lcms/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/lcms/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/lcms/js/datatables.min.js') }}"></script>    

    @stack('head')

    <style type="text/css">
        .msg-unread {
            padding: 5px;
            line-height: 1.2;
            margin-top: 5px;
        }

        .msg-unread:hover {
            background-color: #f2f2f2;
        }

        .msg-unread a {
            display: contents;
        }

        [data-action="back"]::after {
          content: '\ee40';
        }

        .navbar-brand{
            padding-top: 8px;
            padding-bottom: 0;
        }

        .navbar-brand img {
          height: 26px;
          margin-top: 6px;
        }

        @media (min-width: 768px) {
            .navbar-expand-md .navbar-brand {
              min-width: 11.2rem;
            }
        }

        .sidebar {
          width: 16rem;
        }

        /* Data tables */
        .datatable-footer > div:first-child, .datatable-header > div:first-child {
          margin-left: 1.25rem;
        }

        .datatable-header {
            padding-bottom: 1.2rem;
        }

        .dataTables_filter > label {
          position: relative;
          display: -ms-flexbox;
          display: flex;
          -ms-flex-align: center;
          align-items: center;
        }

        .form-control-feedback {
          position: relative;
          padding-right: 0;
        }

        .dataTables_filter input {
            width: 17rem;
        }        
    </style>

</head>

<body>

    @include('lcms::layout-inc.top_menu')

    <!-- Page content -->
    <div class="page-content">

        @include('lcms::layout-inc.side_menu')   

        @yield('sidebar_sec')

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">

                @include('lcms::layout-inc.header')

                <!-- Content area -->
                <div class="content">

                    <!-- Info & alert -->
                    {{--Error Alert Area--}}
                    @if($errors->any())
                        <div class="alert alert-danger border-0 alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

                                @foreach($errors->all() as $er)
                                    <span><i class="icon-arrow-right5"></i> {{ $er }}</span> <br>
                                @endforeach

                        </div>
                    @endif
                    <div id="ajax-alert" style="display: none"></div>
                    <!-- /info & alert -->

                    @yield('content')

                    @yield('footer')

                </div>
                <!-- /content area -->

                @include('lcms::layout-inc.footer')          

            </div>
            <!-- /inner content -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->


    {{-- Notification --}}
    <script src="{{ asset('vendor/lcms/js/sweet_alert2.min.js') }}"></script>
    <script src="{{ asset('vendor/lcms/js/pnotify.min.js') }}"></script>
    <script src="{{ asset('vendor/lcms/js/app.js') }}"></script>    
    <script src=" {{ asset('vendor/lcms/js/custom.js') }} "></script>
    @include('lcms::layout-inc.js.custom_js') 
    @stack('footer')

</body>
</html>
