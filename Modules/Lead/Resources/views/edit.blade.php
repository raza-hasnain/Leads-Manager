{!!Form::open(['route'=>array('leads.edit',$lead->id),'id'=>'lead-edit-form']) !!}
<div class="modal-header">
    <h5 class="modal-title">@lang('leads.lead_information')</h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
    <input type="hidden" id="form_submited" class="lead-id-{{clean($lead->id)}}">
    @requiredInfo
    <div class="form-group m-form__group row">

        <div class="col-lg-4">
            <label>
                @lang('leads.source') @required
            </label>
            <select name="lead_source_id" id="lead_source" class="form-control">
                @foreach($sources as $source) <option  value="{{ clean($source->id) }}"@if($lead->lead_source_id == $source->id) selected @endif>{{ clean($source->name) }}</option> @endforeach
            </select>
        </div>
        <div class="col-lg-4">
            <label>
                @lang('layout.status') @required
            </label>
            <select name="lead_status_id" class="form-control">
                @foreach($statuses as $status) <option selected value="{{ clean($status->id) }}"@if($lead->lead_status_id == $status->id) selected @endif>{{ clean($status->name) }}</option> @endforeach
            </select>
        </div>
        <div class="col-lg-4">
            <label>
                @lang('layout.assigned') 
            </label>
            <select name="assigned_to" class="form-control basic-single" >
                @foreach($users as $user) <option  value="{{ clean($user->id) }}"@if($lead->assigned_to == $user->id) selected @endif>{{ clean($user->name) }}</option> @endforeach
            </select>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-4">
            <label>
                @lang('layout.fname') @required
            </label>
            <input type="text" name="first_name" class="form-control m-input m-input--solid" placeholder="@lang('layout.name')" value="{{clean($lead->first_name)}}">
        </div>
        <div class="col-lg-4">
            <label>
                @lang('layout.lname')
            </label>
            <input type="text" name="last_name" class="form-control m-input m-input--solid" placeholder="@lang('layout.name')" value="{{clean($lead->last_name)}}">
        </div>
        <div class="col-lg-4">
            <label class="">
                @lang('users.e-mail') @required
            </label>
            <input type="email" name="email" class="form-control m-input m-input--solid" placeholder="@lang('users.e-mail')" value="{{clean($lead->email)}}">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-4">
            <label class="">
                @lang('country.country') @required
            </label>
            <select type="text" onchange="changeNumberCode(this.value)" name="country_id" class="form-control m-input m-input--solid select2" placeholder="">
                <option value="">@lang('layout.select')</option>
                @php echo get_option($country,'id','name', $lead->country_id) @endphp
            </select>
        </div>
        <div class="col-lg-2">
            <label>
                @lang('country.country_code') @required
            </label>
            <input type="text" name="country_code" id="phone_code" readonly class="form-control m-input m-input--solid" placeholder="---" value="{{ $lead->country  ? clean($lead->country->country_code) : '' }}">
        </div>
        <div class="col-lg-4">
            <label>
                @lang('layout.phone_number') @required
            </label>
            <input type="number" name="phone" class="form-control m-input m-input--solid" placeholder="@lang('layout.phone_number')" value="{{clean($lead->phone)}}">
        </div>
        <div class="col-lg-2">
            <label>
                @lang('layout.state')
            </label>
            <input type="text" name="state" class="form-control m-input m-input--solid" placeholder="@lang('layout.state')" value="{{clean($lead->state)}}">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label class="">
                @lang('layout.address')
            </label>
            <input type="text" name="address" class="form-control m-input m-input--solid" placeholder="@lang('layout.address')" value="{{clean($lead->address)}}">
        </div>
        <div class="col-lg-2">
            <label>
                @lang('layout.zip_code')
            </label>
            <input type="number" name="zip_code" class="form-control m-input m-input--solid" placeholder="1234" value="{{clean($lead->zip_code)}}">
        </div>
        <div class="col-lg-4">
            <label>
                @lang('layout.city')
            </label>
            <input type="text" name="city" class="form-control m-input m-input--solid" placeholder="@lang('layout.city')" value="{{clean($lead->city)}}">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label class="">
                @lang('layout.company')
            </label>
            <input type="text" name="company" class="form-control m-input m-input--solid" placeholder="@lang('layout.company')" value="{{clean($lead->company)}}">
        </div>
        <div class="col-lg-6">
            <label class="">
                @lang('layout.position')
            </label>
            <input type="text" name="position" class="form-control m-input m-input--solid" placeholder="@lang('layout.position')" value="{{clean($lead->position)}}">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-12">
            <label>
                @lang('layout.website')
            </label>
            <input type="text" name="website" class="form-control m-input m-input--solid" placeholder="@lang('layout.website')" value="{{clean($lead->website)}}">
        </div>
       
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-12">
            <label class="">
                @lang('layout.description')
            </label>
            <textarea rows="4" id="description" class="form-control" name="description" autocomplete="off">{{clean($lead->description)}}</textarea>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-12">
            <label class="">
                @lang('layout.summary')
            </label>
            <textarea rows="2" id="summary" class="form-control" name="summary" autocomplete="off">{{clean($lead->summary)}}</textarea>
        </div>
    </div>
</div>
<div class="modal-footer lead_submit">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" id="submitEditLead" class="btn btn-base">@lang('layout.save')</button>
</div>
<script src="{{asset('public/admin_layout/js/Modules/Leads/edit.js')}}?v={{ $version }}"></script> 