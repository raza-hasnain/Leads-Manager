{!!Form::open(['route'=>array('invoice.edit',$estimate->id),'id'=>'edit-estimate-form','enctype' => 'multipart/form-data']) !!}
<div class="card mb-4">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fs-17 font-weight-600 mb-0">@lang('sales.update_invoice')</h6>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0">@lang('sales.invoice_details')</h6>
                    </div>
                </div>
            </div> 
            <div class="card-body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label>
                            @lang('invoice.invoice_number') @required
                        </label>
                        <input type="text" name="invoice_number" class="form-control m-input m-input--solid" value="{{clean($estimate->invoice_number)}}">
                    </div>
                    <div class="col-lg-4">
                        <label>
                            @lang('layout.status') @required
                        </label>
                        <select name="status_id" class="form-control">
                            @foreach($statuses as $status) @required
                            <option @if($estimate->status_id == $status->id) selected @endif value="{{ clean($status->id) }}">{{ clean($status->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-lg-4 module_member">
                        <label class="label">
                            @lang('layout.select_name') @required
                        </label>
                        <input type="text" name="module_member_id" class="form-control m-input m-input--solid" value="{{clean($estimate->customer->name)}}" disabled>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label>
                            @lang('layout.reference')
                        </label>
                        <input type="text" name="reference" class="form-control m-input m-input--solid" value="{{clean($estimate->reference)}}" placeholder="@lang('layout.reference')">
                    </div>
                    <div class="col-lg-2">
                        <label>
                            @lang('layout.date') @required
                        </label>
                        <input class="date_value form-control m-input m-input--solid" type="text" name="open_date" value="{{clean($estimate->open_date)}}" />
                    </div>
                    <div class="col-lg-2">
                        <label>
                            @lang('sales.open_till') @required
                        </label>
                        <input class="date_value form-control m-input m-input--solid" type="text" name="expiry_date" value="{{clean($estimate->expiry_date)}}" />
                    </div>
                    <div class="col-lg-4">
                        <label>
                            @lang('layout.client_note')
                        </label>
                        <textarea class="form-control" name="client_note" id="post_text" rows="1"  placeholder="@lang('layout.client_note')" >{{isset($estimate->client_note) ? clean($estimate->client_note):""  }}</textarea>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="col-lg-12" id="proposal_to_details">
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
                        <input type="text" name="send_to" class="form-control m-input m-input--solid" value="{{clean($estimate->send_to)}}" placeholder="@lang('layout.name')" >
                    </div>
                    <div class="col-lg-6">
                        <label>
                            @lang('layout.email') @required
                        </label>
                        <input type="email" name="email" class="form-control m-input m-input--solid" placeholder="@lang('layout.email')" value="{{clean($estimate->customer->email)}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label>
                            @lang('country.country') @required
                        </label>
                        <select type="text" onchange="changeNumberCode(this.value)" name="country_id" class="form-control m-input m-input--solid">
                            <option value="">@lang('layout.select')</option>
                            @if($estimate->country_id)
                            <option selected value="{{clean($estimate->country->id)}}">{{clean($estimate->country->name)}}</option>
                            @endif
                            @php echo get_option($country,'id','name') @endphp
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <label class="">
                            @lang('country.country_code') @required
                        </label>
                        <input type="text" name="phone_code" id="phone_code" readonly class="form-control m-input m-input--solid" value="{{ $estimate->country_id ? clean($estimate->country->country_code) : '---' }}">
                    </div>
                    <div class="col-lg-4">
                        <label class="">
                            @lang('layout.phone_number') @required
                        </label>
                        <input type="number" name="phone" class="form-control m-input m-input--solid" placeholder="@lang('layout.phone_number')" value="{{clean($estimate->phone_no)}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label>
                            @lang('layout.address')
                        </label>
                        <input type="text" name="address" class="form-control m-input m-input--solid" placeholder="@lang('layout.address')" value="{{ $estimate->address ? clean($estimate->address) : '' }}">
                    </div>
                    <div class="col-lg-3">
                        <label>
                            @lang('layout.city')
                        </label>
                        <input type="text" name="city" class="form-control m-input m-input--solid" placeholder="@lang('layout.city')" value="{{ $estimate->city ? clean($estimate->city) : '' }}">
                    </div>
                    <div class="col-lg-3">
                        <label>
                            @lang('layout.postal_code')
                        </label>
                        <input type="number" name="zip_code" class="form-control m-input m-input--solid" placeholder="@lang('layout.postal_code')" value="@if($estimate->zip_code) {{clean($estimate->zip_code)}} @elseif($estimate->postal_code) {{clean($estimate->postal_code)}} @else @endif">
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
                            <th>@lang('Description')</th>
                            <th>@lang('invoice.qty')</th>
                            <th>@lang('Rate')</th>
                            <th class="text-right">@lang('Amount')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estimate->invoice_items as $item)
                        <tr>
                            <td>
                                <textarea name="description[]" rows="2" placeholder="Description" aria-invalid="false" class="form-control form-control-sm" autocomplete="off" required>{{clean($item->description)}}</textarea>
                                <input type="hidden" value="{{clean($item->item_id)}}" name='item_id[]'>
                            </td>
                            <td>
                                <textarea name="long_description[]"  rows="2" placeholder="Description" aria-invalid="false" class="form-control form-control-sm" autocomplete="off" required>{{clean($item->long_description)}}</textarea>
                            </td>
                            <td width="10%" class="cal">
                                <input type="text" name="quantity[]" placeholder="Quantity" class="form-control form-control-sm text-center calculate_sub quantity" autocomplete="off" value="{{clean($item->quantity)}}">
                            </td>
                            <td width="10%" class="cal">
                                <input type="text" name="rate[]" placeholder="Rate" aria-invalid="false" class="form-control form-control-sm text-center calculate_sub rate" autocomplete="off" required value="{{clean($item->rate)}}">
                            </td>
                            <td>
                                <span class="ibtnDel btn-danger btn-sm float-left"><i class="far fa-trash-alt"></i></span>
                                <span class="float-right d-inline show_item_val" >{{clean($item->sub_total)}}</span>
                                <input type="hidden" name="sub_total[]" class="item_value_val" value="{{clean($item->sub_total)}}">
                            </td>
                        </tr>
                        @endforeach
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
                            <td class="sub_total"><span class="su_total">{{clean($estimate->sub_ptotal)}}</span>  <input type="hidden" id="sub_total" name="sub_ptotal" value="{{clean($estimate->sub_ptotal)}}"></td>
                        </tr>
                        <tr id="discount_area">
                            <td>
                                <div class="row">
                                    <div class="col-md-7">
                                        <span class="bold">@lang('invoice.discount')</span>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group" >
                                            <input type="hidden" id="discount_method_id" value="{{clean($estimate->discount_method_id)}}" v-model="discount_method_id" name="discount_method_id">
                                            <div class="input-group">
                                                <input type="number" min="1" name="discount_rate"  id="discount_rate" onblur="changeDiscount(this)"  class="form-control form-control-sm text-right" value="{{clean($estimate->discount_rate)}}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle discount_method_btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> @if($estimate->discount_method_id == 1)(@lang('invoice.f'))
                                    @else
                                    %
                                    @endif</button>
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
                                <span id="discount-total-text">{{clean($estimate->discount_total)}}</span>
                                <input type="hidden" name="discount_total" id="discount-total" value="{{clean($estimate->discount_total)}}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-7">
                                        <span class="bold">@lang('invoice.adjustment')</span>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="number" id="adjustment-data" v-model="adjustment" onblur="justment(this)"  class="form-control form-control-sm text-right" name="adjustment" value="{{clean($estimate->adjustment)}}">
                                    </div>
                                </div>
                            </td>
                            <td class="adjustment">
                                <span id="adjustment">{{clean($estimate->adjustment)}}</span><input type="hidden" id="adjustment-input"    value="{{clean($estimate->adjustment)}}">
                            </td>
                        </tr>
                        <tr>
                            <td><span class="bold">@lang('invoice.total') :</span></td>
                            <td class="total" ><span id="total">{{clean($estimate->total)}}</span><input type="hidden" id="total-input" name="total" value="{{clean($estimate->total)}}"  v-model="total" ></td>
                        </tr>
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
    <div class="col-sm-12 text-right submit-estimate mb-2">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><a href="{{route('estimates.index')}}" class="text-white">@lang('layout.back')</a></button>
        <button id="submit_estimate" type="button" class="btn btn-success mr-5">@lang('layout.save')</button>
    </div>
</div>
<script src="{{asset('public/admin_layout/js/Modules/Estimates/edit.js')}}?v={{ $version }}"></script>