    <!-- Content Header (Page header) -->
    <div class="content-header">
    	<div class="header-icon">
            <i class="ti-layers-alt text-base statistic_icon"></i>
        </div>
        <div class="header-title">
            <div class="lead_name">
                <h1>@lang('sales.proposals')- {{clean($estimate->title)}}</h1>
                <small>{{clean($estimate->status->name)}}</small>
            </div>
            <ul class="more">
                <li class="dropdown float-right">
                    <button type="button" class="btn btn-light dropdown-toggle " data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a class="px-2 edit-tr" id="edit-tr-{{clean($estimate->id)}}"><i class="fas fa-edit pr-1"></i> @lang('layout.edit_details')</a></li>
                    </ul>
                </li>
            </ul>
           
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
                        <h4 class="mt-0">{{clean($estimate->send_to)}}</h4>
                        <p class="m-0"><i class="pe-7s-map-marker"></i>{{clean($estimate->country->name)}}</p>
                    </div>
                    <div class="card-content-languages">
                        <div class="card-content-languages-group">
                            <div>
                                <h4>@lang('layout.status'):</h4>
                            </div>
                            <div>
                                <ul>
                                    <li>{{clean($estimate->status->name)}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content-languages-group">
                            <div>
                                <h4>@lang('layout.assigned'):</h4>
                            </div>
                            <div>
                                <ul>
                                    <li>{{clean($estimate->created_user->name)}}
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
                                    <li><b>{{clean($estimate->source->module_name)}}</b></li>
                                </ul>
                            </div>

                        </div>
                        <div class="card-content-languages-group">
                            <div>
                                <h4>@lang('layout.created_at'):</h4>
                            </div>
                            <div>
                                <ul>
                                    <li>{{clean($estimate->created_at)}}</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                   
                    <div class="card-content-summary ">
                        <table>
                            <h5>Contact Info</h5>
                            <tbody>
                                <tr>
                                    <td>@lang('layout.email'):</td>
                                    <td>{{clean($estimate->email)}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.phone'):</td>
                                    <td>{{clean($estimate->country->country_code) }}{{clean($estimate->phone_no) }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.address'):</td>
                                    <td>{{clean($estimate->address)}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.city'):</td>
                                    <td>{{clean($estimate->city)}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.state'):</td>
                                    <td>{{clean($estimate->state)}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('layout.zip_code'):</td>
                                    <td>{{clean($estimate->zip_code)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header" id="proposed_persondetails">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">@lang('sales.proposal_items')</h6>
                        </div>
                    </div>  
                </div> 
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table items estimate-items-preview">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="description text-left">@lang('invoice.item')</th>
                                    <th class="description text-left">@lang('layout.description')</th>
                                    <th class="text-right">@lang('invoice.qty')</th>
                                    <th class="text-right">@lang('invoice.rate')</th>
                                    <th class="text-right">@lang('invoice.amount')</th>
                                </tr>
                            </thead>
                            <tbody class="ui-sortable">
                                @php($i = 1)
                                @foreach($estimate->estimate_items as $item)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td class="description text-left">
                                        <span><strong>{{clean($item->description)}}</strong></span>
                                    </td>
                                    <td class="description text-left">
                                        <span><strong>{{clean($item->long_description)}}</strong></span>
                                    </td>
                                    <td class="text-right">{{clean($item->quantity)}}</td>
                                    <td class="text-right">{{clean($item->rate)}}</td>
                                    <td class="text-right">{{clean($item->sub_total)}}</td>
                                </tr>
                                @php($i++)
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-8 offset-md-4">
                    <table class="table text-right">
                        <tbody>
                            <tr>
                                <td><span class="bold">@lang('invoice.sub_total')</span></td>
                                <td class="subtotal">{{clean($estimate->sub_ptotal)}}</td>
                            </tr>
                            <tr>
                                <td><span class="bold">@lang('invoice.discount_amount')</span>
                                    @if($estimate->discount_method_id == 1)<span>(@lang('invoice.f'))</span>
                                    @else
                                    <span>(%)</span>
                                    @endif
                                </td>
                                <td class="total">{{clean($estimate->discount_total)}}</td>
                            </tr>
                            @if($estimate->adjustment !== null)
                            <tr>
                                <td><span class="bold">@lang('invoice.adjustment')</span></td>
                                <td class="total">{{clean($estimate->adjustment)}}</td>
                            </tr>
                            @endif
                            <tr>
                                <td><span class="bold">@lang('invoice.total')</span></td>
                                <td class="total">{{clean($estimate->total)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>   
            </div>  
        </div>
    </div>
<script src="{{asset('public/admin_layout/js/Modules/Proposals/view_proposal.js')}}?v={{ $version }}"></script>