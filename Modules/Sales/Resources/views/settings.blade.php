@extends('layouts.admin.admin_layout')
@section('css')
  <!-- Settings PAGE PLUGINS --> 
  <link href="{{asset('public/admin_layout/plugins/bootstrap-toggle/bootstrap-toggle.min.css')}}?v={{ $version }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<!-- Settings Page Elements --> 
<div class="content">
  <!--row-->
  <div class=" row">
    <div class="col-md-12">
      <!-- Nav tabs -->
        <ul class="metismenu nav nav-tabs border-bottom-0 border-right-0 float-left w-20" role="tablist" id="menu1">
          <li class="nav-item w-100">
            <a class="nav-link active br-radius-0 rounded" data-toggle="tab" href="#tabs3-1">@lang('sales.items')</a>
          </li>
        </ul>
      <!-- Tab panels -->
        <div class="tab-content float-left w-75">
          <div id="tabs3-1" class="container tab-pane active">
            <div class="row">
              <div class="col-md-8">
                <div class="card itemcategory" data-sortable="true">
                  <div class="card-header">
                    <div class="card-title">
                      @lang('sales.category')
                      <button class="btn btn-base btn-sm addcategory float-right"><i class="fas fa-plus"></i> @lang('sales.new_category')</button>
                    </div>
                  </div>
                  <div class="card-block p-3 basic-forms" id="categories">

                  </div>
                </div>           
              </div>
            </div>
          </div>
        </div>
      </div>
  </div><!--/row-->
</div>
<!-- End Settings Page Elements --> 
@endsection

@section('js')
  <script src="{{asset('public/admin_layout/plugins/bootstrap-toggle/bootstrap-toggle.min.js')}}?v={{ $version }}"></script>
<script src="{{asset('public/admin_layout/js/Modules/Sales/settings.js')}}?v={{ $version }}"></script>

@endsection