    <!-- Content Header (Page header) -->
    <div class="content-header">
    	<div class="header-icon">
            <i class="ti-layers-alt text-base statistic_icon"></i>
        </div>
        <div class="header-title">
            <div class="lead_name">
                <h1>@lang('leads.leads')- {{clean($lead->first_name).' '. clean($lead->last_name)}}</h1>
                <small>{{clean($lead->status->name)}}</small>
            </div>
            @if(\Auth::User()->can('edit',app('Modules\Lead\Entities\Lead')))
            <ul class="more">
                <li class="mr-2 float-left"><button class="btn btn-base log_touch mb-2" id="log-tr-{{clean($lead->id)}}"> @lang('task.log_activeties')</button></li>
                <li class="mr-2 float-left"><button class="btn btn-base convert_customer mb-2" id="convert-tr-{{clean($lead->id)}}"><i class="fas fa-user"></i> @lang('leads.convert_to_customer')</button></li>
                <li class="dropdown float-right">
                    <button type="button" class="btn btn-light dropdown-toggle mb-2" data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a class="px-2 edit-tr" id="edit-tr-{{clean($lead->id)}}"><i class="fas fa-edit pr-1"></i> @lang('layout.edit_details')</a></li>
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
                        <i class="glyphicon glyphicon-star" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as important"></i>
                    </div>
                    <div class="card-header-headshot"></div>
                </div>
                <div class="card-content">
                    <div class="card-content-member">
                        <h4 class="mt-0">{{clean($lead->first_name).' '. clean($lead->last_name)}}</h4>
                        <p class="m-0"><i class="pe-7s-map-marker"></i>{{isset($lead->country->name) ? clean($lead->country->name):''}}</p>
                    </div>
                    <div class="card-content-languages">
                        <div class="card-content-languages-group">
                            <div>
                                <h4>@lang('layout.status'):</h4>
                            </div>
                            <div>
                                <ul>
                                    <li>{{clean($lead->status->name)}}
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
                                    <li>{{ isset($lead->assigned_to) ? clean($lead->assigned->name) : 'N/A' }}
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
                                    <li><i class="{{clean($lead->source->icon)}} mr-1"></i><b>{{clean($lead->source->name)}}</b></li>
                                </ul>
                            </div>

                        </div>
                        <div class="card-content-languages-group">
                            <div>
                                <h4>@lang('layout.created_at'):</h4>
                            </div>
                            <div>
                                <ul>
                                    <li>{{clean($lead->created_at)}}</li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-content-summary ">
                        <table>
                            <h5>@lang('leads.contact_info')</h5>
                            <tbody>
                                <tr>
                                    <td>@lang('layout.email'):</td>
                                    <td>{{clean($lead->email)}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.phone'):</td>
                                    <td>{{isset($lead->country->name) ? clean($lead->country->country_code):''}} {{clean($lead->phone) }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.address'):</td>
                                    <td>{{clean($lead->address)}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.city'):</td>
                                    <td>{{clean($lead->city)}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.state'):</td>
                                    <td>{{clean($lead->state)}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.zip_code'):</td>
                                    <td>{{clean($lead->zip_code)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer p-0 chat_box">
                    @if(\Auth::User()->can('send',app('Modules\Lead\Entities\Lead')))
                    <div class="contact">
                        @if($lead->social_id_link !=null)
                        <div class="d-none" id="customer-message" data-id="{{clean($lead->id)}}"> </div>
                        <h4 class="mb-2 card-footer-message text-white text-center cursor-pointer"  id="fid" data-id="{{clean($lead->social_id_link)}}" data-name="{{clean($lead->first_name).' '.clean($lead->last_name)}}"><i class="fa fa-comments mr-2" ></i>@lang('layout.message')</h4>
                        <h4 class="mb-2 card-footer-message text-white text-center cursor-pointer" id="email" data-id="{{clean($lead->id)}}" data-name="{{clean($lead->first_name).' '.clean($lead->last_name)}}"><i class="fa fa-comments mr-2" ></i>@lang('layout.mail')</h4>
                        @else
                        <h4 class="mb-2 card-footer-message text-white text-center cursor-pointer" id="email" data-id="{{clean($lead->id)}}" data-name="{{clean($lead->first_name).' '.clean($lead->last_name)}}"><i class="fa fa-comments mr-2" ></i>@lang('layout.mail')</h4>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-header bg-white">
                        <h4>@lang('leads.contact_history')</h4>
                    </div>
                    <div class="card-content-summary">
                        <table>
                            <tbody>
                                <tr>
                                    <td>@lang('leads.last_contacted'):</td>
                                    <td>{{ isset($lead->last_contacted) ? clean($lead->last_contacted) : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('leads.last_contacted_by'):</td>
                                    <td>{{ isset($lead->last_contacted_by) ? clean($lead->contacted->name)  : 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.created_at'):</td>
                                    <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($lead->created_at))->diffForHumans() }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-white">
                            <div class="text-right">
                                <div class="d-inline float-left">
                                    <h4>@lang('layout.summary')</h4>
                                </div>
                                <div class="d-inline summary card_buttons">
                                    @if(\Auth::User()->can('edit',app('Modules\Lead\Entities\Lead')))
                                    <button class="btn btn-base add_summary" id="summary-{{clean($lead->id)}}" ><i class="fas fa-plus"></i> @lang('layout.add_summary')</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>{{clean($lead->summary)}}</p>
                        </div>
                    </div>
                </div>      
            </div>  
            <div class="p-15">
                <span class="d-none" id="leads" data-id="{{clean($lead->id)}}"> </span>
                <div class="row">
                    <div class="col-md-12 p-0">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs1-1">@lang('layout.description')</a>
                            </li>
                            <li class="nav-item" id="get_estimates">
                                <a class="nav-link estimates" id="get_estimate-{{clean($lead->id)}}" data-toggle="tab" href="#tabs1-2">@lang('sales.estimates')</a>
                            </li>
                            <li class="nav-item" id="get_proposals">
                                <a class="nav-link proposals" id="get_proposal-{{clean($lead->id)}}" data-toggle="tab" href="#tabs1-3">@lang('sales.proposals')</a>
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
                        <div class="tab-content  bg-white p-2 pb-3">
                            <div id="tabs1-1" class="container tab-pane fade active show"><br>
                                <p class="fs-13">{{clean($lead->description)}}</p>
                            </div>
                            <div id="tabs1-2" class="container tab-pane">
                            </div>
                            <div id="tabs1-3" class="container tab-pane">
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
<script src="{{asset('public/admin_layout/js/Modules/Leads/showlead.js')}}?v={{ $version }}"></script>  