

<div class="modal-header">

    <h5 class="modal-title">@lang('task.view_task')</h5>
 <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
    
    <div class="row">
        <div class="col-md-4">
            <label>
                @lang('layout.title') 
            </label></div>
            <div class="col-md-6">
           
                {{clean($task->title)}} 
            </div>
           <div class="col-md-4">
            <label>
                @lang('layout.description') 
            </label></div>
            <div class="col-md-8">
           
                {{clean($task->description)}} 
            </div>
            <div class="col-md-4">
            <label>
                @lang('layout.priorities') 
            </label></div>
            <div class="col-md-8">
           
                {{clean($task->priorities->name)}} 
            </div>
              <div class="col-md-4">
            <label>
                @lang('layout.status') 
            </label></div>
            <div class="col-md-8">
           
                {{clean($task->status->name)}} 
            </div>
         <div class="col-md-4">
            <label>
                @lang('layout.start_date') 
            </label></div>
            <div class="col-md-8">
           
                {{clean($task->start_date)}} 
            </div>
             <div class="col-md-4">
            <label>
                @lang('layout.end_date') 
            </label></div>
            <div class="col-md-8">
           
                {{clean($task->deadline)}} 
            </div>
               <div class="col-md-4">
            <label>
                @lang('layout.assigned') 
            </label></div>
            <div class="col-md-8">
           
                {{clean($task->user->name)}} 
            </div>
    </div>
    
    

    <hr>
 
</div>


