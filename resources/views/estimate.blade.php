@extends('layouts.app')
@section('content')

            <div class="content-pdf">
                <!-- Main content -->
                <div class="content">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                          <div class="header-icon">
                              <i class="pe-7s-news-paper"></i>
                          </div>
                          <div class="header-title">
                             @if($estimate->type == 0)
                            <h1>@lang('sales.estimate')</h1>
                            @else
                            <h1>@lang('sales.proposal')</h1>
                            @endif
                            <h1 class="breadcrumb mx-4">{{clean($estimate->title)}}</h1>
                          </div>
                      </div>
                <!-- /. Content Header (Page header) -->
                      <div class="clearfix"></div>
                      <!-- page conntent-->
                  <div class="panel panel-bd mb-4 bg-white @if($estimate->status_id == 5) d-none @endif" id="estimate_body">
                      <div class="panel-body py-4 px-3">
                          <div class="row">
                              <div class="col-sm-6">
                                  <img src="data:image/png;base64,@if(isset($company->logo)){{
                                    imgbase64($company->logo)
                           
                        }}
                        @else
                        {{imgbase64('some/logo/logo.png')}}
                        @endif" class="img-responsive" alt="">
                                  <br>
                                  <address class="fs-13">
                                      <strong>{{clean($estimate->address)}}</strong><br>
                                      {{clean($estimate->city)}}<br>
                                      {{isset($estimate->state) ? clean($estimate->state):''}}<br>
                                      <abbr title="Phone"><i class="fa fa-phone mr-1"></i></abbr>{{clean($estimate->country->country_code)}}-{{clean($estimate->phone_no)}}
                                  </address>
                                  <address class="fs-13">
                                      <strong>{{clean($estimate->send_to)}}</strong><br>
                                      <a href="mailto:#">{{clean($estimate->email)}}</a>
                                  </address>
                              </div>
                              <div class="col-sm-6 text-right">
                                  <h1 class="mt-0">
                                      @if($estimate->type == 0)
                                        @lang('sales.estimate')
                                     @else
                                        @lang('sales.proposal')
                                    @endif
                                    #00{{clean($estimate->id)}}</h1>
                                  <div class="fs-13">@lang('layout.created_at') {{clean($estimate->open_date)}}</div>
                                  <div class="text-danger fs-13">@lang('sales.open_till') {{clean($estimate->expiry_date)}}</div>
                              </div>
                          </div>
                          <hr>
                          <div class="table-responsive mb-3">
                              <table class="table table-striped">
                                  <thead>
                                      <tr>
                                          <th class="border-top-0">@lang('sales.item_list')</th>
                                          <th class="border-top-0">@lang('sales.qty')</th>
                                          <th class="border-top-0">@lang('sales.unit')</th>
                                          <th class="border-top-0">@lang('sales.price')</th>
                                          <th class="border-top-0">@lang('sales.tp')</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($estimate->estimate_items as $item)
                                      <tr>
                                          <td class="w-50"><div><strong>{{clean($item->description)}}</strong></div>
                                              <small>{{clean($item->long_description)}}</small></td>
                                          <td>{{clean($item->quantity)}}</td>
                                          <td>{{clean($item->unit)}}</td>
                                          <td>{{clean($item->rate)}}</td>
                                          <td>{{clean($item->sub_total)}}</td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                          </div>
                          <div class="row">
                              <div class="col-sm-8 fs-13">
                                  <p>{{clean($estimate->client_note)}}</p>
                                  <p><strong>@lang('sales.t_text')</strong></p>
                              </div>
                              <div class="col-sm-4">
                                  <ul class="list-unstyled text-left fs-13">
                                        <li>
                                          <strong>@lang('invoice.sub_total'):</strong> ${{clean($estimate->sub_ptotal)}} </li>
                                        @if($estimate->discount_rate != null)
                                        <li>
                                          <strong>@lang('invoice.discount'):</strong> {{clean($estimate->discount_rate)}}% </li>
                                        @endif
                                        <li>
                                          <strong>@lang('invoice.discount_amount'):</strong> {{clean($estimate->discount_total)}} </li>
                                        @if($estimate->adjustment !== null)
                                        <li>
                                          <strong>@lang('invoice.adjustment'):</strong> {{clean($estimate->adjustment)}} </li>
                                        @endif
                                        <li>
                                          <strong>@lang('invoice.total'):</strong> ${{clean($estimate->total)}} </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                   @guest
                      <div class="panel-footer text-left shadow border estimate_submit">
                          <button type="button" class="btn btn-base accept" data-url="{{route('estimates.estimatecusstatuschange',['estimate_id'=>$estimate->estimate_number,'status'=>1])}}" id="estimate-{{clean($estimate->estimate_number)}}"><i class="fa fa-check"></i>@lang('sales.accept')</button>
                          <button type="button" class="btn btn-danger deny" data-url="{{route('estimates.estimatecusstatuschange',['estimate_id'=>$estimate->estimate_number,'status'=>0])}}" id="estimate-{{clean($estimate->estimate_number)}}">
                          <i class="fa fa-close"></i> @lang('sales.deny')</i></button>
                      </div>
                      @endguest
                     
                      @auth
                      <div class="panel-footer text-left shadow border estimate_submit">
                        
                          <button type="button" class="btn btn-danger cancel"  >
                          @lang('layout.cancel')</i></button>
                      </div>
                      @endauth
                  </div>
                    <div class="panel panel-bd mb-4 bg-white  @if($estimate->status_id != 5) d-none @endif" id="estimate_con">
                      <div class="panel-body py-4 px-3">
                          
                          <div class="row">
                              <h1 class="col-sm-12 text-center text-base pb-3">@lang('layout.congratulation')</h1>
                              <div class="col-sm-12 text-center fs-13">
                                  <p><strong>@lang('sales.t_text')</strong></p>
                              </div>
                              </div>
                          
                          </div>
                          </div>
                </div><!-- /content -->

              </div>


@endsection
@section('js_t')
<script src="{{route('assets.lang')}}?v={{ $version }}"></script>
<script src="{{asset('public/admin_layout/js/ajaxCustom.js')}}?v={{ $version }}"></script>
<script src="{{asset('public/admin_layout/plugins/toastr/toastr.min.js')}}?v={{ $version }}"></script>  

  
<script src="{{asset('public/admin_layout/js/estimate_status.js')}}?v={{ $version }}"></script>
@endsection
