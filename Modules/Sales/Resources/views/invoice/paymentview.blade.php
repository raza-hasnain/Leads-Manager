

<div class="modal-header">

    <h5 class="modal-title">@lang('invoice.view_payment')</h5>
 <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
    
    <div class="row">
        <div class="col-md-4">
            <label>
                @lang('invoice.invoice_number') 
            </label></div>
            <div class="col-md-6">
           
                #INV-{{clean($payment->invoice->invoice_number)}} 
            </div>
            <div class="col-md-4">
            <label>
                @lang('layout.total') 
            </label></div>
            <div class="col-md-6">
           
                {{clean($payment->invoice->total)}} 
            </div>
           <div class="col-md-4">
            <label>
                @lang('invoice.transaction_id') 
            </label></div>
            <div class="col-md-8">
           
                {{clean($payment->refernce_number)}} 
            </div>
            <div class="col-md-4">
            <label>
                @if($payment->payment->type == 1)
                @lang('invoice.bank_name') 
                @else
                 @lang('layout.name') 
                @endif
            </label></div>
            <div class="col-md-8">
           
                {{clean($payment->title)}} 
            </div>
             <div class="col-md-4">
            <label>
                @if($payment->payment->type == 1)
                @lang('invoice.transcation_number') 
                @else
                 @lang('layout.phone') 
                @endif
            </label></div>
            <div class="col-md-8">
           
                {{clean($payment->title_number)}} 
            </div>
            @if($payment->payment->type == 1)
            <div class="col-md-4">
            <label>
               
                 @lang('invoice.swift_no') 
               
            </label></div>
            <div class="col-md-8">
           
                {{clean($payment->swift_no)}} 
            </div>
            @endif
              
               <div class="col-md-4">
            <label>
                @lang('layout.amount') 
            </label></div>
            <div class="col-md-8">
           
                {{clean($payment->amount)}}  
            </div>
                <div class="col-md-4">
            <label>
                @lang('invoice.due') 
            </label></div>
            <div class="col-md-8">
           
                {{clean($payment->due)}}
            </div>
             <div class="col-md-4">
            <label>
                @lang('invoice.paid_date') 
            </label></div>
            <div class="col-md-8">
           
                {{clean($payment->created_at)}} 
            </div>
               <div class="col-md-4">
            <label>
                @lang('invoice.sign_by') 
            </label></div>
            <div class="col-md-8">
           
                {{clean($payment->user->name)}} 
            </div>
    </div>
    
    

    <hr>
 
</div>