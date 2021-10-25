@extends('layouts.app')
@section('content')
<div class="modal fade modal-success" id="ajax-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
	<div  class="modal-dialog modal-lg">
	    <div class="modal-content" id="modal-ajaxview">
{!!Form::open(['route'=>array('customer_invite',$source_id),'id'=>'customer-queryadd-form']) !!}
<div class="modal-header">
    <h5 class="modal-title">@lang('layout.query_form')</h5>
</div>

<div class="modal-body bg-white">
    @requiredInfo
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label>
                @lang('layout.name') @required
            </label>
            <input type="text" name="name" class="form-control m-input m-input--solid" placeholder="@lang('layout.name')">
        </div>
        <div class="col-lg-6">
            <label class="">
                @lang('users.e-mail') @required
            </label>
            <input type="email" name="email" class="form-control m-input m-input--solid" placeholder="@lang('users.e-mail')">
        </div>
    </div>
  
    <div class="form-group m-form__group row">
        <div class="col-lg-4">
            <label class="">
                @lang('country.country') @required
            </label>
            <select type="text" onchange="changeNumberCode(this.value)" name="country_id" class="form-control m-input m-input--solid select2" placeholder="">
                <option value="">@lang('layout.select')</option>
                @php echo get_option($country,'id','name', '1') @endphp
            </select>
        </div>

        <div class="col-lg-2">
            <label>
                @lang('country.country_code') @required
            </label>
            <input type="text" name="country_code" id="phone_code" readonly class="form-control m-input m-input--solid" placeholder="---" value="880">
        </div>
        <div class="col-lg-6">
            <label>
                @lang('layout.phone_number') @required
            </label>
            <input type="text" name="phone" class="form-control m-input m-input--solid" placeholder="@lang('layout.phone_number')">
        </div>
        
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label class="">
                @lang('layout.address')
            </label>
            <input type="text" name="address" class="form-control m-input m-input--solid" placeholder="@lang('layout.address')">
        </div>
        <div class="col-lg-2">
            <label>
                @lang('layout.postal_code')
            </label>
            <input type="text" name="zip_code" class="form-control m-input m-input--solid" placeholder="1234">
        </div>
        <div class="col-lg-4">
            <label>
                @lang('layout.city')
            </label>
            <input type="text" name="city" class="form-control m-input m-input--solid" placeholder="@lang('layout.city')">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-4">
            <label class="">
                @lang('layout.company')
            </label>
            <input type="text" name="company" class="form-control m-input m-input--solid" placeholder="@lang('layout.company')">
        </div>
        <div class="col-lg-4">
            <label>
                @lang('layout.position')
            </label>
            <input type="text" name="position" class="form-control m-input m-input--solid" placeholder="@lang('layout.position')">
        </div>
        <div class="col-lg-4">
            <label>
                @lang('layout.website')
            </label>
            <input type="text" name="website" class="form-control m-input m-input--solid" placeholder="@lang('layout.website')">
        </div>
    </div>
</div>

<div class="modal-footer customer_querysubmit bg-white">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" id="add_customer" class="btn btn-base">@lang('layout.submit')</button>
</div>
{!! Form::close() !!}
</div>
</div>
	</div>

@endsection

@section('js_t')
<script src="{{route('assets.lang')}}?v={{ $version }}"></script>
<script src="{{asset('public/admin_layout/js/ajaxCustom.js')}}?v={{ $version }}"></script>
<script src="{{asset('public/admin_layout/plugins/toastr/toastr.min.js')}}?v={{ $version }}"></script>  


<script src="{{asset('public/admin_layout/js/QueryCustomer.js')}}?v={{ $version }}"></script> 
@endsection

