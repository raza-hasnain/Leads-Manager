<div class="card mb-4">
    <div class="card-header" id="proposed_persondetails">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fs-17 font-weight-600 mb-0">@lang('sales.customer_details')</h6>
            </div>
        </div>   
    </div> 
    <div class="card-body">
        <div class="form-group m-form__group row">
            <div class="col-lg-6">
                <label>
                    @lang('layout.name')
                </label>
                <input type="text" name="send_to" class="form-control m-input m-input--solid" value="@if($member->name){{clean($member->name)}}@else {{clean($member->first_name).' '.clean($member->last_name)}}@endif" placeholder="@lang('layout.name')" >
            </div>
            <div class="col-lg-6">
                <label>
                    @lang('layout.email') @required
                </label>
                <input type="email" name="email" class="form-control m-input m-input--solid" placeholder="@lang('layout.email')" value="{{clean($member->email)}}">
            </div>
        </div>
        <div class="form-group m-form__group row">
            <div class="col-lg-6">
                <label>
                    @lang('country.country') @required
                </label>
                <select type="text" onchange="changeNumberCode(this.value)" name="country_id" class="form-control m-input m-input--solid">
                    <option value="">@lang('layout.select')</option>
                    @if($member->country_id)
                        <option selected value="{{clean($member->country->id)}}">{{clean($member->country->name)}}</option>
                    @endif
                    @php echo get_option($country,'id','name') @endphp
                       
                </select>
            </div>
            <div class="col-lg-2">
                <label class="">
                    @lang('country.country_code') @required
                </label>
                <input type="text" name="phone_code" id="phone_code" readonly class="form-control m-input m-input--solid" value="{{ $member->country_id ? clean($member->country->country_code) : '---' }}">
            </div>
            <div class="col-lg-4">
                <label class="">
                    @lang('layout.phone_number') @required
                </label>
                <input type="text" name="phone_no" class="form-control m-input m-input--solid" placeholder="@lang('layout.phone_number')" value="@if($member->phone) {{clean($member->phone)}} @elseif($member->phone_no) {{clean($member->phone_no)}} @else @endif">
            </div>
        </div>
        <div class="form-group m-form__group row">
            <div class="col-lg-6">
                <label>
                    @lang('layout.address')
                </label>
                <input type="text" name="address" class="form-control m-input m-input--solid" placeholder="@lang('layout.address')" value="{{ $member->address ? clean($member->address) : '' }}">
            </div>
            <div class="col-lg-3">
                <label>
                    @lang('layout.city')
                </label>
                <input type="text" name="city" class="form-control m-input m-input--solid" placeholder="@lang('layout.city')" value="{{ $member->city ? clean($member->city) : '' }}">
            </div>
            <div class="col-lg-3">
                <label>
                    @lang('layout.postal_code')
                </label>
                <input type="number" name="zip_code" class="form-control m-input m-input--solid" placeholder="@lang('layout.postal_code')" value="{{clean($member->zip_code)}}">
            </div>
        </div>
    </div> 
</div>
    <div class="card mb-4">
        <div class="card-header" id="proposed_persondetails">
            <div class="row form-group m-form__group">
                <div class="col-md-6">
                    <select name="item" class="form-control item_data" id="item_details">
                    </select>
                </div>
            </div>
        </div> 
        <div class="card-body">
                <table id="item" class="table order-list">
                    <thead>
                        <tr>
                            <th>@lang('Items')</th>
                            <th>@lang('layout.description')</th>
                            <th>@lang('invoice.qty')</th>
                            <th>@lang('Rate')</th>
                            <th class="text-right">@lang('Amount')</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>                       
                </table>
                <table class="table text-right">
                    <tbody>
                        <tr id="add_new">
                            <div class="text-left mb-2">
                                <div class="actions">
                                    <button id="addrow" type="button" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> @lang('layout.add_new_line')</button>
                                </div>
                            </div>
                        </tr>
                        <tr id="subtotal">
                            <td><span class="bold">@lang('invoice.total') :</span></td>
                            <td class="sub_total"><span class="su_total"></span>  <input type="hidden" id="sub_total" name="sub_ptotal" value="0"></td>
                        </tr>
                        <tr id="discount_area">
                        <td>
                            <div class="row">
                                <div class="col-md-7">
                                    <span class="bold">@lang('invoice.discount')</span>
                                </div>
                                <div class="col-md-5">
                                    <div class="input-group" >
                                        <input type="hidden" id="discount_method_id" value="0" v-model="discount_method_id" name="discount_method_id">
                                        <div class="input-group">
                                            <input type="number" min="1" name="discount_rate"  id="discount_rate" onblur="changeDiscount(this)"  class="form-control form-control-sm text-right">
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-outline-primary dropdown-toggle discount_method_btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">%</button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item text-right" onclick="discountMethodChanged(0,'%');" >%</a>
                                                    <a class="dropdown-item text-right" onclick="discountMethodChanged(1,'@lang('invoice.f')');"  >@lang('invoice.fixed_amount')</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="discount-total">
                            <span id="discount-total-text">0.00</span>
                            <input type="hidden" name="discount_total" id="discount-total">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-7">
                                    <span class="bold">@lang('invoice.adjustment')</span>
                                </div>
                                <div class="col-md-5">
                                    <input type="number" min="1" id="adjustment-data" v-model="adjustment" onblur="justment(this)"  class="form-control form-control-sm text-right" name="adjustment">
                                </div>
                            </div>
                        </td>
                        <td class="adjustment">
                            <span id="adjustment">0.00</span><input type="hidden" id="adjustment-input"    >
                        </td>
                    </tr>
                    <tr>
                        <td><span class="bold">@lang('invoice.total') :</span></td>
                        <td class="total" ><span id="total"></span><input type="hidden" id="total-input" name="total" value=""  v-model="total" ></td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group m-form__group row">
            <div class="col-lg-12">
                <label>
                    @lang('invoice.admin_note')
                </label>
                <textarea name="admin_note" class="form-control m-input m-input--solid" ></textarea>
            </div>
        </div>
        </div> 
    </div>
<script src="{{asset('public/admin_layout/js/Modules/Proposals/member_to.js')}}?v={{ $version }}"></script>