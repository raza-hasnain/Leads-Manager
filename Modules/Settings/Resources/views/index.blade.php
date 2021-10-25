@extends('layouts.admin.admin_layout')
@section('css')
  <!-- Settings PAGE PLUGINS --> 
  <link href="{{asset('public/admin_layout/plugins/icheck/skins/all.css')}}?v={{ $version }}" rel="stylesheet" type="text/css">

  <link href="{{asset('public/admin_layout/plugins/bootstrap-toggle/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<!-- Settings Page Elements --> 
<div class="content mb-3">
  <!--row-->
  <div class="card">
    <div class=" p-2">
      @lang('menu.Settings')
    </div>
    <hr>
  <div class=" row">
    <div class="col-md-12">
     <div class="row">
      <div class="col-md-3">
      <!-- Nav tabs -->
        <ul class="nav nav-tabs border-bottom-0 border-right-0 float-left w-100 ml-2 mb-2" role="tablist">
          
          <li class="nav-item w-100 border">
            <a class="nav-link  br-radius-0 rounded" id="add_user" data-toggle="tab" href="#tabs3-2"><i class="far fa-user mr-1"></i>@lang('settings.add_user')</a>
          </li>
           <li class="nav-item w-100 border">
            <a class="nav-link  br-radius-0 rounded" id="user_list" data-toggle="tab" href="#tabs3-2"><i class="fa fa-group mr-1"></i>@lang('settings.user_list')</a>
          </li>
            <li class="nav-item w-100 border">
            <a class="nav-link  br-radius-0 rounded" id="role_permission" data-toggle="tab" href="#tabs3-2"><i class="fa fa-thermometer-0 mr-1"></i>@lang('settings.role_permission')</a>
          </li>
           <li class="nav-item w-100 border">
            <a class="nav-link  br-radius-0 rounded" id="role_list" data-toggle="tab" href="#tabs3-2"><i class="fa fa-key mr-1"></i>@lang('settings.role_list')</a>
          </li>
          <li class="nav-item w-100 border">
            <a class="nav-link  br-radius-0 rounded" id="module_setting" data-toggle="tab" href="#tabs3-2"><i class="fa fa-key mr-1"></i>@lang('settings.modules_setting')</a>
          </li>
         
          <li class="nav-item w-100 border">
            <a class="nav-link  br-radius-0 rounded" id="add_language" data-toggle="tab" href="#tabs3-2"><i class="fa fa-universal-access mr-1"></i>@lang('settings.add_language')</a>
          </li>
          <li class="nav-item w-100 border">
            <a class="nav-link  br-radius-0 rounded" id="translation_language" data-toggle="tab" href="#tabs3-2"><i class="fa fa-sign-language mr-1"></i>@lang('settings.add_phrase')</a>
          </li>
          <li class="nav-item w-100 border">
            <a class="nav-link  br-radius-0 rounded" id="pusher_settings" data-toggle="tab" href="#tabs3-1"><i class="fa fa-rub mr-1"></i>@lang('settings.pusher_settings')</a>
          </li>
          <li class="nav-item w-100 border">
            <a class="nav-link  br-radius-0 rounded" id="email_config" data-toggle="tab" href="#tabs3-2"><i class="fa fa-envelope-open-o mr-1"></i>@lang('settings.email_config')</a>
          </li>
          
           <li class="nav-item w-100 border">
            <a class="nav-link  br-radius-0 rounded" id="country_setting" data-toggle="tab" href="#tabs3-2"><i class="fa fa-globe mr-1"></i>@lang('settings.country_settings')</a>
          </li>
          

            <li class="nav-item w-100 border">
            <a class="nav-link  br-radius-0 rounded" id="app_setting" data-toggle="tab" href="#tabs3-2"><i class="fa fa-gears mr-1"></i>@lang('settings.app_settings')</a>
          </li>
          <li class="nav-item w-100 border">
            <a class="nav-link  br-radius-0 rounded" id="time_zone_setting" data-toggle="tab" href="#tabs3-2"><i class="fas fa-bell mr-1"></i>@lang('settings.time_zone_setting')</a>
          </li>
        </ul>
      </div>

      <!-- Tab panels -->
      <div class="col-md-9">
        <div class=" float-right w-100" id="tab_setting">
          
        </div><!--/tab-content-->
      </div>
     </div>
      </div><!--/col-12-->
  </div><!--/row-->
</div>
</div>
<!-- End Settings Page Elements --> 
@endsection

@section('js')
<script src="{{asset('public/admin_layout/plugins/icheck/icheck.min.js')}}?v={{ $version }}"></script>
  <script src="{{asset('public/admin_layout/plugins/bootstrap-toggle/bootstrap-toggle.min.js')}}?v{{$version}}"></script>
  <script src="{{asset('public/admin_layout/js/Modules/Settings/settings.js')}}?v{{$version}}"></script>
@endsection