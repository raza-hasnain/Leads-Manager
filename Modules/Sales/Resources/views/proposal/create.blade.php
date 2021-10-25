{!!Form::open(['route'=>'proposals.add','id'=>'create-estimate-form','enctype' => 'multipart/form-data']) !!}
<!-- Content Header (Page header) -->
<div class="row mb-2 ml-1">
    <div class="content-header">
        <div class="header-icon">
            <i class="fas fa-file-alt text-base statistic_icon"></i>
        </div>
        <div class="header-title">
            <div class="lead_name">
                <h1>@lang('sales.new_proposal')</h1>
            </div>
        </div>
    </div>
</div>
<!-- /. Content Header (Page header) -->
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">@lang('sales.proposal_details')</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label>
                            @lang('layout.title') @required
                        </label>
                        <input type="text" name="title" class="form-control m-input m-input--solid" placeholder="@lang('layout.name')">
                    </div>
                    <div class="col-lg-2">
                        <label>
                            @lang('layout.status') @required
                        </label>
                        <select name="status_id" class="form-control">
                            @foreach($statuses as $status) @required
                                <option  value="{{ clean($status->id) }}">{{ clean($status->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 module_select">
                        <label>
                            @lang('sales.source') @required
                        </label>
                        <select name="module_id" class="form-control" id="module_id">
                            <option  value="">@lang('Select')</option>
                            @foreach($sources as $data)
                            <option  value="{{ clean($data->id) }}">{{ clean($data->module_name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 module_member">
                        <label class="label">
                            @lang('layout.select_name') @required
                        </label>
                        <select name="module_member_id" class="form-control select2" id="module_member_id"></select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label>
                            @lang('layout.reference')
                        </label>
                        <input type="text" name="reference" class="form-control m-input m-input--solid" placeholder="@lang('layout.reference')">
                    </div>
                    <div class="col-lg-2">
                        <label>
                            @lang('layout.date') @required
                        </label>
                        <input class="date_value form-control m-input m-input--solid" type="text" name="open_date" value="" />
                    </div>
                    <div class="col-lg-2">
                        <label>
                            @lang('sales.open_till') @required
                        </label>
                        <input class="date_value form-control m-input m-input--solid" type="text" name="expiry_date" value="" />
                    </div>
                    <div class="col-lg-4">
                        <label>
                            @lang('layout.client_note')
                        </label>
                        <textarea class="form-control" name="client_note" id="post_text" rows="1" placeholder="@lang('layout.client_note')"></textarea>
                    </div>
                </div>
            </div>        
        </div>
    </div>
    <div class="col-lg-12" id="proposal_to_details">
        <!-- Details from Proposal -->
    </div>
    <div class="col-sm-12 text-right submit-proposal mb-2">
        <button type="button" class="btn btn-danger"><a href="{{route('proposals.index')}}" class="text-white">@lang('layout.back')</a></button>
        <button id="submit_proposal" type="button" class="btn btn-success mr-5">@lang('layout.save')</button>
    </div>  
</div>
{!! Form::close() !!}
<script src="{{asset('public/admin_layout/js/Modules/Proposals/create_proposal.js')}}?v={{ $version }}"></script>
