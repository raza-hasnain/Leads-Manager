<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
  
  
    <!-- START THEME LAYOUT STYLE -->
    <link href="{{ asset('public/admin_layout/css/style.css')}}?v={{ $version }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/admin_layout/css/custom.css')}}?v={{ $version }}" rel="stylesheet" type="text/css"/>
   
    </head>
    <body {{$pdf_style}}>

            <div class="content-pdf">
                <!-- Main content -->
          
                     
                
                        
                              <table class="table content-pdf">
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
                                      <strong>{{clean($invoice->address)}}</strong><br>
                                      {{clean($invoice->city)}}<br>
                                      {{isset($invoice->state) ? $invoice->state:$invoice->country->name}}<br>
                                      <abbr title="Phone"><i class="fa fa-phone mr-1"></i></abbr>{{clean($invoice->country->country_code)}}-{{clean($invoice->phone_no)}}
                                  </address>
                                  <address class="fs-13">
                                     
                                      <a href="mailto:#">{{clean($invoice->customer->email)}}</a>
                                  </address>
                             
                              </td>
                              <td>
                              
                                  <h3 class="mt-0 w-100 text-right">@lang('invoice.invoice') #00{{clean($invoice->invoice_number)}}</h3>
                                  <div class="fs-13 w-100 text-right">@lang('layout.created_at') {{clean($invoice->open_date)}}</div>
                                  <div class="text-danger w-100 fs-13 text-right">@lang('sales.open_till') {{clean($invoice->expiry_date)}}</div>
                              
                              </td>
                              </tr>
                              </table>
                      
                          <hr>
                         
                              <table class="table table-striped content-pdf">
                                  <thead>
                                      <tr>
                                          <th class="border-top-0">@lang('sales.item_list')</th>
                                          <th class="border-top-0">@lang('sales.qty')</th>
                                         
                                          <th class="border-top-0">@lang('sales.price')</th>
                                          <th class="border-top-0 text-right">@lang('sales.tp')</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($invoice->invoice_items as $item)
                                      <tr>
                                          <td class="w-50"><div><strong>{{clean($item->description)}}</strong></div>
                                              
                                          <td>{{clean($item->quantity)}}</td>
                                          
                                          <td>{{clean($item->rate)}}</td>
                                          <td class="text-right">{{clean($item->sub_total)}}</td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                         
                          <div class="row">
                              <table class="table content-pdf">
                                  <tr>
                                     <td width="60%" ></td>
                              <td  >
                         
                                  <ul class=" w-100 list-unstyled text-right fs-13 pr-2">
                                        <li>
                                          <strong>@lang('invoice.sub_total'):</strong> ${{clean($invoice->sub_ptotal)}} </li>
                                        @if($invoice->discount_rate != null)
                                        <li>
                                          <strong>@lang('invoice.discount'):</strong> {{clean($invoice->discount_rate)}}% </li>
                                        @endif
                                        <li>
                                          <strong>@lang('invoice.discount_amount'):</strong> {{clean($invoice->discount_total)}} </li>
                                        @if($invoice->adjustment !== null)
                                        <li>
                                          <strong>@lang('invoice.adjustment'):</strong> {{clean($invoice->adjustment)}} </li>
                                        @endif
                                        <li>
                                          <strong>@lang('invoice.total'):</strong> ${{clean($invoice->total)}} </li>
                                        
                                         <li class="text-danger"> <strong>@lang('invoice.due'):</strong> ${{$pay->due ?? $invoice->total}} </li>
                                  </ul>
                              
                              </td>
                              
                              </tr>
                              <table class="table content-pdf">
                              <tr>
                                 <td class="w-100">
                              <div class="col-sm-8 fs-13">
                                  <p>{{clean($invoice->client_note)}}</p>
                                  <p><strong>@lang('sales.t_text')</strong></p>
                              </div>
                              </td>
                               </tr>
                              </table>
                          </div>
                      </div>
                      
             
</body>
</html>