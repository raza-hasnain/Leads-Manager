@extends('layouts.app')
@section('content')

            <div class="content-pdf">
                <!-- Main content -->
          
                        <div class="content-header pt-2">
                            
                          <div class="header-icon">
                              <i class="pe-7s-news-paper"></i>
                          </div>
                          <div class="header-title">
                             <h1 class="mx-4">{{clean($estimate->title)}}</h1>
                          </div>
                      </div>
                
                  <div class="panel panel-bd mb-4 bg-white">
                      <div class="panel-body py-4 px-3">
                        
                              <table class="table">
                                  <tr>
                                      <td>
                            
                                    <img src="data:image/png;base64,@if(isset($company->logo)){{
                                    imgbase64($company->logo)
                           
                        }}
                        @else
                        {{imgbase64('some/logo/logo.png')}}
                        @endif" class="img-responsive pb-2" alt="test">
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
                             
                              </td>
                              <td>
                              
                                  <h3 class="mt-0 w-100 text-right">@lang('sales.estimate') #00{{clean($estimate->id)}}</h3>
                                  <div class="fs-13 w-100 text-right">@lang('layout.created_at') {{clean($estimate->open_date)}}</div>
                                  <div class="text-danger w-100 fs-13 text-right">@lang('sales.open_till') {{clean($estimate->expiry_date)}}</div>
                              
                              </td>
                              </tr>
                              </table>
                      
                          <hr>
                          <div class="table-responsive mb-3">
                              <table class="table table-striped">
                                  <thead>
                                      <tr>
                                          <th class="border-top-0">@lang('sales.item_list')</th>
                                          <th class="border-top-0">@lang('sales.qty')</th>
                                          <th class="border-top-0">@lang('sales.unit')</th>
                                          <th class="border-top-0">@lang('sales.price')</th>
                                          <th class="border-top-0 text-right">@lang('sales.tp')</th>
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
                                          <td class="text-right">{{clean($item->sub_total)}}</td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                          </div>
                          <div class="row">
                              <table class="table">
                                  <tr>
                              
                              <td  >
                         
                                  <ul class=" w-100 list-unstyled text-right fs-13 pr-2">
                                        <li>
                                          <strong>@lang('invoice.sub_total'):</strong> ${{clean($estimate->sub_ptotal)}} </li>
                                        @if($estimate->discount_rate != null)
                                        <li>
                                          <strong>@lang('invoice.discount'):</strong> {{clean($estimate->discount_rate)}}% </li>
                                        @endif
                                        <li>
                                          <strong>@lang('invoice.discount_amount'):</strong> {{$estimate->discount_total}} </li>
                                        @if($estimate->adjustment !== null)
                                        <li>
                                          <strong>@lang('invoice.adjustment'):</strong> {{clean($estimate->adjustment)}} </li>
                                        @endif
                                        <li>
                                          <strong>@lang('invoice.total'):</strong> ${{clean($estimate->total)}} </li>
                                  </ul>
                              
                              </td>
                              
                              </tr>
                              <tr>
                                 <td class="w-100">
                              <div class="col-sm-8 fs-13">
                                  <p>{{clean($estimate->client_note)}}</p>
                                  <p><strong>@lang('sales.t_text')</strong></p>
                              </div>
                              </td>
                               </tr>
                              </table>
                          </div>
                      </div>
                      
                  </div>
                    
                

              </div>
@endsection