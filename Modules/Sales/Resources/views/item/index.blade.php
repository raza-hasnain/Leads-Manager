@extends('layouts.admin.admin_layout')
@section('css')
<link rel="stylesheet" href="{{asset('public/admin_layout/css/chat.css')}}?v={{ $version }}">
<link rel="stylesheet" href="{{asset('public/admin_layout/plugins/datetimepicker/datetimepicker.min.css')}}?v={{ $version }}">
@endsection

@section('content')
<div class="content" id="ajaxview">
  <div class="row">
    <div class="col-lg-12" >
      <div class="record-selection-table">
        <div class="p-4 bg-white rounded mb-4">
          <div class="table_basic">
            <div class=" text-right">
              <div class="d-inline float-left my-2">
                <i class="fas fa-table"></i>
                @lang('sales.items')
              </div>
              <div class="d-inline card_buttons">
                <div class="dropdown d-inline item_import_data">
                  <button type="button" class="btn btn-base btn-icon-sm dropdown-toggle btn-toggle-none mb-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-long-arrow-alt-up"></i>
                    @lang('layout.import')<i class="fs-11 ml-1 fas fa-chevron-down"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                    <ul class="">
                      <li class=" ">
                        <span class="ml-2">@lang('layout.cap')</span>
                      </li>
                      <li class="item_import_file" id="file-id-1">
                        <a class="">
                          <i class=""></i>
                          <span class="">@lang('layout.excel')</span>
                        </a>
                      </li>
                      <li class="item_import_file" id="file-id-2">
                        <a class="">
                          <i class="fas fa-file-csv"></i>
                          <span class="">@lang('layout.csv')</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div> 
                <div class="dropdown d-inline">
                  <button type="button" class="btn btn-base btn-icon-sm dropdown-toggle btn-toggle-none mb-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-long-arrow-alt-down"></i>
                    @lang('layout.export')<i class="fs-11 ml-1 fas fa-chevron-down"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right export_data">
                    <ul class="">
                      <li class="">
                        <span class="ml-2">@lang('layout.cap')</span>
                      </li>
                      <li class="printMe">
                        <a href="{{route('items.print_file')}}" class="">
                          <i class=""></i>
                          <span class="">@lang('layout.print')</span>
                        </a>
                      </li>
                      <li class="export_file">
                        <a href="{{route('items.export_excel_file')}}" class="">
                          <i class=""></i>
                          <span class="">@lang('layout.excel')</span>
                        </a>
                      </li>
                      <li class="export_file">
                        <a href="{{route('items.export_csv_file')}}" class="">
                          <i class=""></i>
                          <span class="">@lang('layout.csv')</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{route('items.export_pdf_file')}}" class="">
                          <i class=""></i>
                          <span class="">@lang('layout.pdf')</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div> 
                <button class="btn btn-base additem mb-2"><i class="fas fa-plus"></i> @lang('sales.new_items')</button>
              </div>
            </div>
            <hr>
            <div class="table-responsive">
              <table class=" table table-bordered table-hover mb-3" id="myTable">
                <thead>
                  <tr>
                    <th class="p-3 bg-none"><input type="checkbox"></th>
                    <th>@lang('users.name')</th>
                    <th>@lang('layout.description')</th>
                    <th>@lang('sales.rate')</th>
                    <th>@lang('sales.category_name')</th>                   
                    <th>@lang('layout.actions')</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </div>
</div>
@endsection

@section('js')
<script src="{{asset('public/admin_layout/js/Modules/Item/index.js')}}?v={{ $version }}"></script>
@endsection
