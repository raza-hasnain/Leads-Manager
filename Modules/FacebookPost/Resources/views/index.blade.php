@extends('layouts.admin.admin_layout')
@section('css')
<link href="{{asset('public/admin_layout/plugins/icheck/skins/all.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/admin_layout/plugins/bootstrap-toggle/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/admin_layout/plugins/datetimepicker/datetimepicker.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="content">
    {!!Form::open(['route'=>array('facebook.post'),'id'=>'post-add-form']) !!}
	<div class="row">
		<div class="col-lg-3 mb-3">
            
		@include('facebookpost::layouts.pagelist')
		@include('facebookpost::layouts.grouplist')
		</div>
		<div class="col-lg-5 mb-2">
			@include('facebookpost::layouts.post_area')
		</div>	
       
        <div class="col-lg-4">
            @include('facebookpost::layouts.preview')
        </div>
	</div>
    {!! Form::close() !!}	
</div>
@endsection

@section('js')

<script src="{{asset('public/admin_layout/plugins/icheck/icheck.min.js')}}?v={{ $version }}"></script>
<script src="{{asset('public/admin_layout/plugins/icheck/icheck-active.js')}}?v={{ $version }}"></script>
<script src="{{asset('public/admin_layout/plugins/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>
<script src="{{asset('public/admin_layout/plugins/lity-lightbox/lity.min.js')}}?v={{ $version }}"></script>
  <script src="{{asset('public/admin_layout/js/Modules/FacebookPost/index.js')}}?v={{ $version }}"></script>
@endsection
