
                <!-- Main content -->
                <div class="content">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                          <div class="header-icon">
                              <i class="pe-7s-news-paper"></i>
                          </div>
                          <div class="header-title mb-2">
                             
                            <h1>@lang('invoice.invoice')</h1>
                              <div class="dropdown d-inline">
									<button type="button" class="btn btn-base btn-icon-sm dropdown-toggle btn-toggle-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-long-arrow-alt-down"></i>
										@lang('layout.export')<i class="fs-11 fas fa-chevron-down"></i>
									</button>
								
									
									<div class="dropdown-menu dropdown-menu-right export_data">
										<ul class="">
											<li class="">
												<span class="ml-2">@lang('layout.cap')</span>
											</li>
											<li class="printMe">
												<a href="{{route('invoice.printdownload',$invoice->id)}}" target="_blank" class="">
													<i class=""></i>
													<span class="">@lang('layout.print')</span>
												</a>
											</li>
																					<li>
												<a href="{{route('invoice.pdfdownload',$invoice->id)}}" class="" >
													<i class=""></i>
													<span class="">@lang('layout.pdf')</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
                            </div>
                           
                                     <div class="form-group m-form__group row">
                             
                        <label class="col-md-2 offset-md-6">
                            @lang('layout.status')
                        </label>
                        <select type="text" name="status" id="status_id" class="form-control m-input m-input--solid select2 col-md-4">
               
                          @php echo get_option($statuses,'id','name', $invoice->status_id ) @endphp
                      </select>
                    
                          </div>
                          
                         
                      </div>
                <!-- /. Content Header (Page header) -->
                      <div class="clearfix"></div>
                      <!-- page conntent-->
                  <div class="panel panel-bd mb-4 bg-white">
                      <div class="panel-body py-4 px-3">
                          <div class="row">
                              <div class="col-sm-6">
                              
                                  <br>
                                  <address class="fs-13">
                                      <strong>{{$invoice->address}}</strong><br>
                                      {{$invoice->city}}<br>
                                      {{isset($invoice->state) ? $invoice->state:$invoice->country->name}}<br>
                                      <abbr title="Phone"><i class="fa fa-phone mr-1"></i></abbr>{{$invoice->country->country_code}}-{{$invoice->phone_no}}
                                  </address>
                                  <address class="fs-13">
                                      <a href="mailto:#">{{$invoice->customer->email}}</a>
                                  </address>
                              </div>
                              <div class="col-sm-6 text-right">
                                  <h4 class="mt-0">
                                  @lang('invoice.invoice') #00{{$invoice->invoice_number}}</h4>
                                  <div class="fs-13">@lang('layout.created_at') {{$invoice->open_date}}</div>
                                  <div class="text-danger fs-13">@lang('sales.open_till') {{$invoice->expiry_date}}</div>
                                  <div class="fs-13">@lang('invoice.create_by') {{clean($invoice->created_user->name)}}</div>
                              </div>
                          </div>
                          <hr>
                          <div class="table-responsive mb-3">
                              <table class="table table-striped">
                                  <thead>
                                      <tr>
                                          <th class="border-top-0">@lang('sales.item_list')</th>
                                          <th class="border-top-0">@lang('sales.qty')</th>
                                          <th class="border-top-0">@lang('sales.price')</th>
                                          <th class="border-top-0">@lang('sales.tp')</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($invoice->invoice_items as $item)
                                      <tr>
                                          <td class="w-50"><div><strong>{{$item->description}}</strong></div>
                                              <small>{{$item->long_description}}</small></td>
                                          <td>{{$item->quantity}}</td>
                                          <td>{{$item->rate}}</td>
                                          <td>{{$item->sub_total}}</td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                          </div>
                          <div class="row">
                              <div class="col-sm-7 fs-13">
                                  <p>{{clean($invoice->client_note)}}</p>
                                  <p><strong>{{clean($invoice->admin_note)}}</strong></p>
                              </div>
                              <div class="col-sm-5">
                                  <ul class="list-unstyled text-left fs-13">
                                        <li>
                                          <strong>@lang('invoice.sub_total'):</strong> ${{$invoice->sub_ptotal}} </li>
                                        @if($invoice->discount_rate != null)
                                        <li>
                                          <strong>@lang('invoice.discount'):</strong> {{$invoice->discount_rate}}@if($invoice->discount_method_id == 0)% @else F @endif </li>
                                        @endif
                                        <li>
                                          <strong>@lang('invoice.discount_amount'):</strong> {{$invoice->discount_total}} </li>
                                        @if($invoice->adjustment !== null)
                                        <li>
                                          <strong>@lang('invoice.adjustment'):</strong> {{$invoice->adjustment}} </li>
                                        @endif
                                        <li>
                                          <strong>@lang('invoice.total'):</strong> ${{$invoice->total}} </li>
                                          <li class="text-danger"> <strong>@lang('invoice.due'):</strong> ${{$pay->due ?? $invoice->total}} </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                     
                  </div>
                    
                </div><!-- /content -->

            