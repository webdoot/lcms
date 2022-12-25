<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="WEBDOOT">

    <title> @yield('page_title') | LCMS </title>

    <link rel="icon" href="{{ asset('vendor/lcms/favicon.png') }}">

    <!-- Global stylesheets -->
    <link href="{{asset('vendor/lcms/css/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/lcms/css/all.min.css')}}" id="stylesheet" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/lcms/css/lcms.css')}}" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- Core JS files -->    
    <script src="{{ asset('vendor/lcms/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/lcms/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/lcms/js/noty.min.js') }}"></script>
    <script src="{{ asset('vendor/lcms/js/ckeditor_classic.min.js') }}"></script>
    <script src="{{ asset('vendor/lcms/js/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/lcms/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/lcms/js/dropzone.min.js') }}"></script>
    <script src="{{ asset('vendor/lcms/js/glightbox.min.js') }}"></script>
    
    <!-- Theme JS files -->
    <script src="{{ asset('vendor/lcms/js/app.js') }}"></script>
    <script src="{{ asset('vendor/lcms/js/lcms.js') }}"></script>

    @include('lcms::layout-inc.custom_css') 

    @stack('head')
    
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
                <div class="alert alert-danger alert-dismissible fade show">                

                    @foreach($errors->all() as $er)
                        <span><i class="icon-arrow-right5"></i> {{ $er }}</span> <br>
                    @endforeach

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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

<script>$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});</script>


@include('lcms::layout-inc.custom_js') 

@stack('footer')

</body>
</html>