{!!Form::open(['route'=>array('task.edit',$task->id),'id'=>'task-edit-form']) !!}

<div class="modal-header">

    <h5 class="modal-title">@lang('task.edit_task')</h5>
 <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
    @requiredInfo
    <div class="form-group m-form__group row">
        <div class="col-md-12">
            <label>
                @lang('layout.title') @required
            </label>
            <input type="text" name="title" class="form-control m-input m-input--solid" placeholder="@lang('layout.name')" value="{{clean($task->title)}}">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-md-12">
            <label>
                @lang('layout.description') @required
            </label>
            <textarea class="form-control m-input" name="description" rows="3" placeholder="@lang('layout.description')">{{clean($task->description)}}</textarea>
        </div>
    </div>
    <div class="form-group m-form__group row">
         
        <div class="col-md-6">
            <label>
                 @lang('layout.priorities') 
            </label>
            <select name="priorities_id" class="form-control">
                @php echo get_option($priorities,'id','name', $task->priorities_id) @endphp
            </select>

         </div>
        <div class="col-md-6">
            <label>
                 @lang('layout.status') 
            </label>
            <select name="status_id" class="form-control">
                @php echo get_option($statuses,'id','name', $task->	status_id) @endphp
            </select>
         </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-md-4">
            <label>
                @lang('layout.start_date') @required
            </label>
            <input id="datetimepick"  class="date_value form-control m-input m-input--solid datetimepick"  type="text" name="start_date" value="{{clean($task->start_date)}}" onkeypress="return false;" onkeyup="return false;"  ondrop="return false;" onpaste="return false;"/>
        </div>
        <div class="col-md-4">
            <label>
                @lang('layout.end_date') @required
            </label>
            <input id="enddate" class="date_value form-control m-input m-input--solid enddate" type="text" name="deadline" value="{{clean($task->deadline)}}" onkeypress="return false;" onkeyup="return false;"  ondrop="return false;" onpaste="return false;"/>
        </div>
        <div class="col-md-4">
            <label>
                 @lang('layout.assigned') 
            </label>
           
            <select name="assigned" class="form-control">
              @php echo get_option($users,'id','name', $task->assigned) @endphp
            </select>
         </div>
    </div>
    <hr>
 
</div>
<div class="modal-footer customer_submit">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" id="add_customer" class="btn btn-base">@lang('layout.save')</button>
</div>
{!! Form::close() !!}
<script src="{{asset('public/admin_layout/js/Modules/Task/store_task.js')}}?v={{ $version }}"></script> 