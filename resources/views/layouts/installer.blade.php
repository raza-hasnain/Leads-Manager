<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$_ENV['APP_NAME']}}</title>
     <link rel="shortcut icon" href="@if(isset($company->logo)){{
                            asset('public/'.$company->icons)
                        }}
                        @else
                        {{asset('public/admin_layout/img/favicon.png')}}
                        @endif" type="image/x-icon">
    <!-- START GLOBAL MANDATORY STYLE -->
    <link href="{{ asset('public/admin_layout/css/base.css')}}?v={{ $version }}" rel="stylesheet" type="text/css">
    <!-- START THEME LAYOUT STYLE -->
    <link href="{{ asset('public/admin_layout/css/style.css')}}?v={{ $version }}" rel="stylesheet" type="text/css"/>
       <link href="{{ asset('public/admin_layout/installer/css/style.css')}}?v={{ $version }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/admin_layout/css/custom.css')}}?v={{ $version }}" rel="stylesheet" type="text/css"/>
   
    <!-- TOASTER -->
        <link rel="stylesheet" href="{{ asset('public/admin_layout/plugins/toastr/toastr.css')}}?v={{ $version }}" />
    </head>
    <body>
        <div class="d-none" id="baseurl">{{ asset(' ') }}</div>
        <!-- Content Wrapper -->
        @yield('content')
        <!-- /.content-wrapper -->
        <!--js lang  -->
         <script src="{{asset('public/admin_layout/js/jquery.min.js')}}?v={{ $version }}"></script>
    <script src="{{asset('public/admin_layout/bootstrap/js/popper.min.js')}}?v={{ $version }}"></script>
    <script src="{{asset('public/admin_layout/bootstrap/js/bootstrap.min.js')}}?v={{ $version }}"></script>
        <script src="{{route('assets.lang')}}?v={{ $version }}"></script>
        <!--Jquery + Bootstrap-->
    
    </body>
</html>