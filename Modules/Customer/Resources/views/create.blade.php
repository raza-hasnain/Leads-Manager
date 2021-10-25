{!!Form::open(['route'=>'customer.add','id'=>'customer-add-form']) !!}
<div class="modal-header">
    <h5 class="modal-title">@lang('customers.add_customer')</h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
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
                @lang('users.e-mail')  @required
            </label>
            <input type="email" name="email" class="form-control m-input m-input--solid" placeholder="@lang('users.e-mail')">
        </div>
        
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label>
                @lang('leads.source') @required
            </label>
            <select name="customer_source_id" id="customer_source_id" class="form-control">
                @foreach($sources as $source) <option  value="{{ clean($source->id) }}">{{ clean($source->name) }}</option> @endforeach
            </select>
        </div>
       
        <div class="col-lg-6">
            <label>
                @lang('customers.vat_id') 
            </label>
            <input type="text" name="vat_number" class="form-control m-input m-input--solid" placeholder="@lang('customers.vat_id')">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-4">
            <label class="">
                @lang('country.country') @required
            </label>

            <!-- used Wrong way -->
            <select type="text" onchange="changeNumberCode(this.value)" name="country_id" class="form-control m-input m-input--solid select2" >
               <option selected >@lang('layout.select')</option>
                @php echo get_option($country,'id','name') @endphp
            </select>
        </div>

        <div class="col-lg-2">
            <label>
                @lang('country.country_code') @required
            </label>
            <input type="text" name="country_code" id="phone_code" readonly class="form-control m-input m-input--solid" placeholder="---" >
        </div>
        <div class="col-lg-3">
            <label>
                @lang('layout.phone_number') @required
            </label>
            <input type="number" name="phone" class="form-control m-input m-input--solid" placeholder="@lang('layout.phone_number')">
        </div>
        <div class="col-lg-3">
            <label>
                @lang('layout.state')
            </label>
            <input type="text" name="state" class="form-control m-input m-input--solid" placeholder="@lang('layout.state')">
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
            <input type="number" name="zip_code" class="form-control m-input m-input--solid" placeholder="1234">
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
<div class="modal-footer customer_submit">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" id="add_customer" class="btn btn-base">@lang('layout.save')</button>
</div>
{!! Form::close() !!}
<script src="{{asset('public/admin_layout/plugins/select2/select2.min.js')}}?v={{ $version }}"></script> 
<script src="{{asset('public/admin_layout/js/Modules/Customers/createCustomer.js')}}?v={{ $version }}"></script>  
