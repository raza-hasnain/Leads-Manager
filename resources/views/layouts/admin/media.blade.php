@extends('layouts.admin.admin_layout')
@section('css')
<link href="{{asset('admin_layout/plugins/icheck/skins/all.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('admin_layout/plugins/bootstrap-toggle/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('admin_layout/plugins/datetimepicker/datetimepicker.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')


<div class="container">
    <div class="row py-3">
    	@foreach($pics as $pic)
        <div class="col-md-3 col-sm-4 col-6 py-2">
            <a href="#galleryModal" data-large-src="{{asset('storage/media/'.$pic->pic_name)}}" data-toggle="modal">
                <img src="{{asset('storage/media/'.$pic->pic_name)}}" class="img-fluid img-thumbnail">
            </a>
        </div>
       
       @endforeach
       
       
      
       
    </div>
</div>

<div id="galleryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-center mb-0"></h3>
                <button type="button" class="close float-right" aria-label="Close" data-dismiss="modal">
                  <span aria-hidden="true">&#xD7;</span>
                </button>
            </div>
            <div class="modal-body p-0 text-center bg-alt">
                <img src="//placehold.it/1200x700/222?text=..." id="galleryImage" class="loaded-image mx-auto img-fluid">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('admin_layout/plugins/icheck/icheck.min.js')}}"></script>
<script src="{{asset('admin_layout/plugins/icheck/icheck-active.js')}}"></script>
<script src="{{asset('admin_layout/plugins/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>
<script src="{{asset('admin_layout/plugins/lity-lightbox/lity.min.js')}}"></script>
  <script src="{{asset('admin_layout/js/Modules/FacebookPost/index.js')}}"></script>
@endsection