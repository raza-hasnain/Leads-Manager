        <link rel="shortcut icon" href="@if(isset($company->logo)){{
                            asset('public/'.$company->icons)
                        }}
                        @else
                        {{asset('public/admin_layout/img/favicon.png')}}
                        @endif" type="image/x-icon">
        <!-- START GLOBAL MANDATORY STYLE -->
        <link href="{{ asset('public/admin_layout/css/base.css')}}?v={{ $version }}" rel="stylesheet" type="text/css">
        <!-- metismenu-3.0.4 -->
        <link rel="stylesheet" href="{{ asset('public/admin_layout/plugins/metismenu-3.0.4/assets/css/mm-min.css')}}?v={{ $version }}" />
        <link rel="stylesheet" href="{{ asset('public/admin_layout/plugins/metismenu-3.0.4/assets/css/mm-vertical-hover.css')}}?v={{ $version }}" />

        <!-- TOASTER -->
        <link rel="stylesheet" href="{{ asset('public/admin_layout/plugins/toastr/toastr.css')}}?v={{ $version }}" />
        <!-- Datatables -->
        <link rel="stylesheet" href="{{ asset('public/admin_layout/plugins/datatables/jquery.dataTables.min.css')}}?v={{ $version }}">

        <!-- START THEME LAYOUT STYLE -->
        <link href="{{ asset('public/admin_layout/css/style.css')}}?v={{Carbon\Carbon::now()}}" rel="stylesheet" type="text/css"/>
        
           <!-- Datatable -->
        <link rel="stylesheet" href="{{asset('public/admin_layout/plugins/datatables/jquery.dataTables.min.css')}}?v={{ $version }}">
          <!-- Sweetalert -->
        <link rel="stylesheet" href="{{asset('public/admin_layout/plugins/sweetalert/sweetalert.css')}}?v={{ $version }}">

          <link rel="stylesheet" href="{{asset('public/admin_layout/plugins/select2/select2.min.css')}}?v={{ $version }}">
          
            <link rel="stylesheet" href="{{asset('public/admin_layout/plugins/icon_dist/css/bootstrap-iconpicker.min.css')}}?v={{ $version }}">
            <link href="{{asset('public/admin_layout/plugins/datetimepicker/datetimepicker.min.css')}}" rel="stylesheet" type="text/css">
        