@extends('layouts.admin.admin_layout')
@section('css')
<link href="{{asset('public/admin_layout/plugins/icheck/skins/all.css')}}?v={{ $version }}" rel="stylesheet" type="text/css">
<link href="{{asset('public/admin_layout/plugins/bootstrap-toggle/bootstrap-toggle.min.css')}}?v={{ $version }}" rel="stylesheet" type="text/css">
<link href="{{asset('public/admin_layout/plugins/datetimepicker/datetimepicker.min.css')}}?v={{ $version }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{asset('public/admin_layout/css/chat.css')}}?v={{ $version }}">
<link href="{{asset('public/admin_layout/plugins/daterangepicker/daterangepicker.css')}}?v={{ $version }}" rel="stylesheet" type="text/css">

@endsection

@section('content')

<div class="content">
   
  <div class="row">
    <div class="col-lg-3 mb-3">
            <!-- Facebook accounts page -->
        @include('facebookpost::layouts.accounts')
      
    </div>
    <div class="col-lg-5 mb-2">
            <!-- Facebook Post Page -->
            <div class="card small-card" data-sortable="true">
    <div class="card-header">
        <div class="card-title">
            <span><i class=ti-facebook></i></span>@lang('facebookpost.preview')
        </div>
    </div>
    <div id="facebookpost-1">
 
    </div>
  </div>
            
    </div>
    <div class="col-lg-4" >
            <!-- Facebook Post Preview Page -->
            @include('facebookpost::layouts.page_report')
    </div>
  </div>  
    
</div>
@endsection

@section('js')
<script src="{{asset('public/admin_layout/plugins/icheck/icheck.min.js')}}?v={{ $version }}"></script>
<script src="{{asset('public/admin_layout/plugins/icheck/icheck-active.js')}}?v={{ $version }}"></script>
<script src="{{asset('public/admin_layout/plugins/bootstrap-toggle/bootstrap-toggle.min.js')}}?v={{ $version }}"></script>
<script src="{{asset('public/admin_layout/js/Modules/FacebookPost/fb_timeline.js')}}?v={{ $version }}"></script>

@endsection
