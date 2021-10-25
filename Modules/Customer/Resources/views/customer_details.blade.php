    <!-- Content Header (Page header) -->
    <div class="page_content" id="page_content">
        <div class="content-header">
           <div class="header-icon">
            <i class="ti-user text-base statistic_icon"></i>
        </div>
        <div class="header-title">
            <div class="customer_name">
                <h1>{{clean($customer->name)}}</h1>
                <small>@if($customer->status == 1)<span class="text-success">@lang('layout.active')</span>@else <span class="text-danger">@lang('layout.inactive')</span>@endif</small>
            </div>
             @if(Auth::user()->can('edit',app('Modules\Customer\Entities\Customer')))
            <ul class="more">
               <li class="dropdown float-right">
                <button type="button" class="btn btn-light dropdown-toggle " data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                <ul class="dropdown-menu dropdown-menu-right">
                     <li><a class="px-2 cp edit-tr" id="edit-tr-{{$customer->id}}"><i class="fas fa-edit pr-1"></i>@lang('layout.edit_details')</a></li>
                    <li><a class="px-2 cp update-tr" id="update-tr-{{$customer->id}}"> @if($customer->status == 0)<i class="fas fa-user-check pr-1"></i><span class="text-success"> @lang('layout.Activate')</span>@else<i class="fas fa-user-times pr-1"></i> <span class="text-danger">@lang('layout.Deactive')</span>@endif</a></li>
                </ul>
            </li>
        </ul>
        @endif
    </div>
</div>
<!-- /. Content Header (Page header) -->

<!-- page conntent-->
<div class="row">
    <div class="col-lg-4">
        <div class="card profile-card">
            <div class="card-header">
                <div class="card-header-menu">
                   
                </div>
                <div class="card-header-headshot"></div>
            </div>
            <div class="card-content">
                <div class="card-content-member">
                    <h4 class="mt-0 cus_name">{{clean($customer->name)}}</h4>
                    <p class="m-0"><i class="pe-7s-map-marker"></i>{{$customer->country->name}}</p>
                </div>
                <div class="scroll">
                    <div class="card-content-languages">
                        <div class="card-content-languages-group">
                            <div>
                                <h4>@lang('layout.status'):</h4>
                            </div>
                            <div>
                                <ul>
                                    <li>@if($customer->status == 1) @lang('layout.active') @else @lang('layout.inactive') @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content-languages-group">
                            <div>
                                <h4>@lang('layout.assigned'):</h4>
                            </div>
                            <div>
                                <ul>
                                    <li>{{ isset($customer->assigned_to) ? clean($customer->assigned->name) : 'N/A' }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content-languages-group">
                            <div>
                                <h4>@lang('layout.source'):</h4>
                            </div>
                            <div>
                                <ul>
                                    <li><i class="{{clean($customer->source->icon)}} mr-1"></i><b>{{clean($customer->source->name)}}</b></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content-languages-group">
                            <div>
                                <h4>@lang('layout.created_at'):</h4>
                            </div>
                            <div>
                                <ul>
                                    <li>{{clean($customer->created_at)}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-content-summary ">
                        <table>
                            <h5>@lang('customers.customers_info')</h5>
                            <tbody>
                                <tr>
                                    <td>@lang('layout.email'):</td>
                                    <td>{{clean($customer->email)}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.phone'):</td>
                                    <td>{{clean($customer->country->country_code) }}{{clean($customer->phone) }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.address'):</td>
                                    <td>{{clean($customer->address)}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.city'):</td>
                                    <td>{{clean($customer->city)}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.state'):</td>
                                    <td>{{clean($customer->state)}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.zip_code'):</td>
                                    <td>{{clean($customer->zip_code)}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('customers.vat_id'):</td>
                                    <td>{{clean($customer->vat_number)}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.social_link'):</td>
                                    <td><a href="{{$customer->social_id_link}}" target="_blank">{{clean($customer->social_id_link)}}</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>  
                    <div class="card-content-summary ">
                        <table>
                            <h5>@lang('customers.company_info')</h5>
                            <tbody>
                                <tr>
                                    <td>@lang('layout.company'):</td>
                                    <td>{{clean($customer->company)}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.position'):</td>
                                    <td>{{clean($customer->position) }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.website'):</td>
                                    <td><a href="{{$customer->website}}" target="_blank">{{clean($customer->website)}}</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>   
                </div>
            </div>
            @if(Auth::user()->can('send',app('Modules\Customer\Entities\Customer')))
            <div class="card-footer p-0 chat_box">
                <div class="contact">
                    @if($customer->social_id_link !=null)
                   <div class="d-none" id="customer-message" data-id="$customer->id"> </div>
                        <h4 class="mb-2 card-footer-message text-white text-center cursor-pointer" id="fid" data-id="{{$customer->social_id_link}}" data-name="{{$customer->name}}" ><i class="fa fa-comments mr-2" ></i>@lang('layout.message')</h4>
                        <h4 class="card-footer-message text-white text-center cursor-pointer" id="email" data-id="{{clean($customer->id)}}" data-name="{{clean($customer->name)}}" ><i class="fa fa-comments mr-2" ></i>@lang('layout.mail')</h4>
                        @else
                        <h4 class="card-footer-message text-white text-center cursor-pointer" id="email" data-id="{{clean($customer->id)}}" data-name="{{clean($customer->name)}}" ><i class="fa fa-comments mr-2" ></i>@lang('layout.mail')</h4>
                        @endif
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-12 mb-0">
                <div class="row stat_area">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="statistic-box dash">
                         
                            <div class="text-info"><h4>@lang('sales.estimates')</h4></div>
                            <h2><span class=count-number>{{isset($c_count[0]) ? $c_count[0]:'0'}}</span></h2>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="statistic-box dash">
                         
                            <div class="text-success"><h4>@lang('sales.proposal')</h4></div>
                            <h2><span class="count-number">{{isset($c_count[1]) ? $c_count[1]:'0'}}</span> </h2>
                        </div>
                    </div>
                       <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="statistic-box dash">
                         
                            <div class="text-success"><h4>@lang('menu.Invoice')</h4></div>
                           <h2><span class="count-number"> {{$Invoice->count() ?? 0}}</span></h2>
                        </div>
                    </div>
                </div>
            </div>
                
        </div>  
        <div class="p-15">
            <span class="d-none" id="customer" data-id="{{clean($customer->id)}}"> </span>
            <div class="row">
                <div class="col-md-12 p-0">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs1-1">@lang('sales.estimates')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs1-2">@lang('sales.proposals')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#invoice-tab">@lang('menu.Invoice')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" id="task-tab" href="#task">@lang('task.task')</a>
                          </li>
                           <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" id="note-tab" href="#note">@lang('note.notes')</a>
                          </li>
                           <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" id="reminder-tab" href="#reminder">@lang('reminder.reminders')</a>
                          </li>
                           <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" id="active-tab" href="#active">@lang('reminder.activites')</a>
                          </li>
                    </ul>
                    <!-- Tab panels -->
                    <div class="tab-content  bg-white">
                        <div id="tabs1-1" class="container tab-pane fade active show"><br>
                            <div class="table-responsive">
                                <table class="table table-hover mb-3" id="estimates">
                                    <thead>
                                        <tr>
                                            <th>@lang('layout.title')</th>
                                            <th>@lang('layout.status')</th>
                                            <th>@lang('layout.date')</th>
                                            <th>@lang('sales.open_till')</th>
                                            <th>@lang('layout.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($estimates as $estimate)
                                        @if($estimate->type==0)
                                        <tr>
                                            <td>{{ clean($estimate->title)}}</td>
                                            <td>{{ clean($estimate->status->name)}}</td>
                                            <td>{{ clean($estimate->open_date)}}</td>
                                            <td>{{ clean($estimate->expiry_date)}}</td>
                                            <td class="view_estimate"><a class="px-2 view-tr cursor-pointer" id="view-tr-{{$estimate->id}}"><i class="fa fa-eye pr-1"></i> @lang('layout.view_details')</a>
                                        <a class="px-2" id="link-tr-{{clean($estimate->id)}}" href="{{route('estimate_link',$estimate->estimate_number)}}" target="_blank"><i class="fa fa-envelop pr-1"></i> @lang('layout.send')  @lang('sales.estimate')</a>
                                        </td>
                                        <td class="view_estimate" ><span class="btn btn-base copy-link" id="copy-tr-{{clean($estimate->id)}}">@lang('sales.copy_link')</span></td>
                                        </tr>
                                        @endif
                                        @empty
                                        <tr>
                                            <td>@lang('layout.no_data')</td>
                                        </tr>
                                            
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="tabs1-2" class="container tab-pane fade"><br>
                            <div class="table-responsive">
                                <table class="table table-hover mb-3" id="proposals">
                                    <thead>
                                        <tr>
                                            <th>@lang('layout.title')</th>
                                            <th>@lang('layout.status')</th>
                                            <th>@lang('layout.date')</th>
                                            <th>@lang('sales.open_till')</th>
                                            <th>@lang('layout.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($estimates as $estimate)
                                        @if($estimate->type==1)
                                        <tr>
                                            <td>{{ clean($estimate->title)}}</td>
                                            <td>{{ clean($estimate->status->name)}}</td>
                                            <td>{{ clean($estimate->open_date)}}</td>
                                            <td>{{ clean($estimate->expiry_date)}}</td>
                                            <td class="view_estimate"><a class="px-2 view-tr cursor-pointer" id="view-tr-{{$estimate->id}}"><i class="fa fa-eye pr-1"></i> @lang('layout.view_details')</a>
                                        <a class="px-2"link-tr-{{clean($estimate->id)}} href="{{route('estimate_link',$estimate->estimate_number)}}" target="_blank"><i class="fa fa-envelop pr-1"></i> @lang('layout.send')  @lang('sales.proposal')e</a>
                                        </td>
                                        <td class="view_estimate" ><span class="btn btn-base copy-link" id="copy-tr-{{clean($estimate->id)}}">@lang('sales.copy_link')</span></td>
                                        </tr>
                                        @endif
                                        @empty
                                        <tr>
                                            <td>@lang('layout.no_data')</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                          <div id="invoice-tab" class="container tab-pane fade"><br>
                            <div class="table-responsive">
							<table class=" table table-bordered table-hover mb-3" id="myTable">
								<thead>
									<tr>
										
                            			<th>@lang('menu.Invoice')</th>
                            			<th>@lang("layout.amount")</th>
                            		   
                            			<th>@lang('layout.status')</th>
									</tr>
								</thead>
								<tbody>
									@foreach($Invoice as $invoice)
									<tr>
									<td class="view-tr text-base" id="view-tr-{{clean($invoice->idclean)}}" data-id="{{clean($invoice->idclean)}}">#00{{clean($invoice->invoice_numberclean)}}</td>
                            			<td>{{clean($invoice->total)}}</td>
                            		
                            			<td>
                            				{{clean($invoice->status->name)}}</td>
                            		</tr>
                            			@endforeach

								</tbody>
							</table>
						</div>
                            </div>
                        
                        <div id="task" class="container tab-pane fade"><br>
                            
                        </div>
                        <div id="note" class="container tab-pane fade"><br>
                            
                        </div>
                        <div id="reminder" class="container tab-pane fade"><br>
                            
                        </div>
                           <div id="active" class="container tab-pane fade"><br>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="chat_box" id="chatbox">
</div>
</div> 
<script src="{{asset('public/admin_layout/js/Modules/Customers/customer_details.js')}}?v={{ $version }}"></script>