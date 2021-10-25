{!!Form::open(['route'=>'settings.country_modal','id'=>'country-update-form']) !!}
<div class="modal-header">
    <h5 class="modal-title">@lang('country.country')</h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">

    
    <div class="form-group m-form__group row">
        <div class="col-lg-12">
            <label class="">
                @lang('users.name') @required
            </label>
            <input type="text" name="name" class="form-control m-input m-input--solid" @if(isset($country)) value="{{clean($country->name)}}" readonly @else placeholder="@lang('users.name')" @endif>
            <!-- used Wrong way -->
           
        </div>

    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label class="">
                @lang('country.iso') @required
            </label>
            @isset($country)
            <input type="hidden" name="id" value='{{clean($country->id)}}'>
            @endisset
            <input type="text" name="iso" class="form-control m-input m-input--solid" @if(isset($country)) value="{{clean($country->iso)}}"  @else placeholder="@lang('country.iso')" @endif>
        </div>

        <div class="col-lg-6">
            <label class="">
                @lang('country.country_code') @required
            </label>
            <input type="number" name="country_code" class="form-control m-input m-input--solid" @if(isset($country)) value="{{clean($country->country_code)}}" @else  placeholder="@lang('country.country_code')" @endif>
        </div>
       
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label class="">
                       @lang('country.min_digits_mobile')
            </label>
            <input type="number" name="min_digits" class="form-control m-input m-input--solid" @if(isset($country)) value="{{clean($country->min_digits)}}" @else placeholder="@lang('country.min_digits_mobile')" @endif>
        </div>
     
    
        <div class="col-lg-6">
            <label class="">
                       @lang('country.max_digits_mobile')
            </label>
            <input type="number" name="max_digits" class="form-control m-input m-input--solid" @if(isset($country)) value="{{clean($country->max_digits)}}" @else placeholder="@lang('country.max_digits_mobile')" @endif>
        </div>
     
    
</div>
<div class="modal-footer country_submit">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" id="add_country" class="btn btn-base">@lang('layout.save')</button>
</div>
{!! Form::close() !!}

<script src="{{asset('public/admin_layout/js/Modules/Settings/add_lang_modal.js')}}?v={{ $version }}"></script>  
