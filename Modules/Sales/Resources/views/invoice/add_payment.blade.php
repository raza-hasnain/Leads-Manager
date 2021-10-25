{!!Form::open(['route'=>array('payment.add',$invoice->id),'id'=>'payment-add-form']) !!}

@if(!$invoice->InvoiceDetails->isEmpty())
@php
$value = $invoice->InvoiceDetails->last();
$due = $value->due;
@endphp
@endif

<div class="modal-header">
    <h5 class="modal-title">@lang('invoice.add_payment')</h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
    
    <div class="form-group m-form__group row mb-2">
              
        
            <label class="col-md-4 mb-2">
                @lang('invoice.total')
            </label>
            <input type="text"  class="form-control m-input m-input--solid col-md-6 mb-2 " value="{{clean($invoice->total)}}" readonly>
       
       
           
      
              <label class="col-md-4">
                @lang('invoice.amount') @required
            </label>
                <input type="number" name="amount"  class="form-control m-input m-input--solid col-md-6 mb-2 " value="{{isset($due) ? clean((int)$due): clean((int)$invoice->total)}}" min="1" max="{{isset($due) ? clean($due): clean($invoice->total)}}" >
          <label class="col-md-4 mb-2">
                @lang('invoice.payment_type') @required
            </label>

            
            <select type="text"  name="payment_id" class="form-control m-input m-input--solid col-md-6 mb-2 " id="paymenttype">
               <option value="">@lang('layout.please_select')</option>
                @foreach($paymenttype as $paymenttype)
                <option value="{{clean($paymenttype->id)}}" data-value="{{clean($paymenttype->type)}}">{{clean($paymenttype->title)}}</option>
                @endforeach
            </select>
            </div>
            <!-- for type -1 -->
            <div class="form-group m-form__group row mb-2 d-none" id="type-one">
            <label class="col-md-4">
                @lang('invoice.Bank_name') 
            </label>
                <input type="text" id="bank-name"  class="form-control m-input m-input--solid col-md-6 mb-2 "  >
                <label class="col-md-4">
                @lang('invoice.IBAN') 
            </label>
                <input type="text" id="bank-number"  class="form-control m-input m-input--solid col-md-6 mb-2 "  >
                  <label class="col-md-4">
                @lang('invoice.SWIFT_code') 
            </label>
                <input type="text" id="bank-code" name="swift_no" class="form-control m-input m-input--solid col-md-6 mb-2 "  >
            </div>
            <!-- for type -0 -->
            <div class="form-group m-form__group row mb-2 d-none" id="type-none">
            <label class="col-md-4">
                @lang('layout.name') 
            </label>
                <input type="text" id="person-name"  class="form-control m-input m-input--solid col-md-6 mb-2 "  >
                <label class="col-md-4">
                @lang('invoice.phone') 
            </label>
                <input type="number" id="person-number"  class="form-control m-input m-input--solid col-md-6 mb-2">
              
            </div>
            <div class="form-group m-form__group row mb-2">
             <label class="col-md-4 mb-2">
                @lang('invoice.recived_by') @required
            </label>

            <!-- used Wrong way -->
            <select type="text"  name="made_by" class="form-control m-input m-input--solid select2 col-md-6 mb-2 " >
               
                @php echo get_option($user,'id','name') @endphp
            </select>
          </div>
    
    
</div>
<div class="modal-footer customer_submit">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" id="add_payment" class="btn btn-base">@lang('layout.save')</button>
</div>
{!! Form::close() !!}
 <script src="{{asset('public/admin_layout/js/Modules/Invoice/invoicedetails.js')}}?v={{ $version }}"></script> 
 
