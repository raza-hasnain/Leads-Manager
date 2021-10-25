

<div class="modal-header">

    <h5 class="modal-title">@lang('reminder.reminders')</h5>
 <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
    
    <div class="row">
       
           <div class="col-md-4">
            <label>
                @lang('layout.description') 
            </label></div>
            <div class="col-md-8">
           
                {{clean($reminder->description)}} 
            </div>
         
          
         <div class="col-md-4">
            <label>
                @lang('layout.start_date') 
            </label></div>
            <div class="col-md-8">
           
                {{clean($reminder->start_date)}} 
            </div>
            
               <div class="col-md-4">
            <label>
                @lang('reminder.reminder_for') 
            </label></div>
            <div class="col-md-8">
           
                {{clean($reminder->user->name)}} 
            </div>
    </div>
    
    

    <hr>
 
</div>