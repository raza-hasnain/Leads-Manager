@extends('layouts.admin.admin_layout')
@section('css')
<link href="{{asset('public/admin_layout/plugins/icheck/skins/all.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/admin_layout/plugins/bootstrap-toggle/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/admin_layout/plugins/datetimepicker/datetimepicker.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="content">
  {!!Form::open(['route'=>array('facebook.submitLinkpost'),'id'=>'post-add-form']) !!}
	<div class="row">
		<div class="col-lg-3 mb-3">
            <!-- Facebook accounts page -->
		@include('facebookpost::layouts.pagelist')
		
		</div>
		<div class="col-lg-5 mb-2">
            <!-- Facebook Post Page -->
			@include('facebookpost::layouts.link_post_area')
		</div>
		<div class="col-lg-4">
            <!-- Facebook Post Preview Page -->
			@include('facebookpost::layouts.link_preview')
		</div>
	</div>	
  {!! Form::close() !!}
</div>
@endsection

@section('js')
<script src="{{asset('public/admin_layout/plugins/icheck/icheck.min.js')}}?v={{ $version }}"></script>
<script src="{{asset('public/admin_layout/plugins/icheck/icheck-active.js')}}?v={{ $version }}"></script>
<script src="{{asset('public/admin_layout/plugins/bootstrap-toggle/bootstrap-toggle.min.js')}}?v={{ $version }}"></script>
<script src="{{asset('public/admin_layout/js/Modules/FacebookPost/link_post.js')}}?v={{ $version }}"></script>    

@endsection
