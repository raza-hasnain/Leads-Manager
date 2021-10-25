{!!Form::open(['route'=>array('lead.active.add'),'id'=>'reminder-add-form']) !!}

<div class="modal-header">
    <input type="hidden" name="module_id" value="{{$modul_id}}">
    <input type="hidden" name="module_member_id" value="{{$modul_member_id}}">
    @if($module_type !=null)
    <input type="hidden" name="module_type" value="{{$module_type}}">
    @endif
    <h5 class="modal-title">@lang('task.log_activeties')</h5>
 <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
    @requiredInfo
    
    <div class="form-group m-form__group row">
         
        <div class="col-md-6">
            <label>
                @lang('layout.date') @required
            </label>
            <input id="datetimepick"  class="date_value form-control m-input m-input--solid datetimepick"   name="date" value="" onkeypress="return false;" onkeyup="return false;"  ondrop="return false;" onpaste="return false;"/>
        </div>
       
        <div class="col-md-6">
            <label>
                 @lang('task.meduim') 
            </label>
           
            <select name="medium" class="form-control">
              @php echo get_option($meduim,'name','name') @endphp
            </select>
         </div>
    <div class="col-md-12">
            <label>
                 @lang('task.resolution') 
            </label>
           
            <select name="resolution" class="form-control">
              @php echo get_option($resolution,'name','name') @endphp
            </select>
         </div>
        <div class="col-md-12">
            <label>
                @lang('layout.description') @required
            </label>
            <textarea class="form-control m-input" name="description" rows="3" placeholder="@lang('layout.description')"></textarea>
        </div>
    </div>
   
   
   
 
</div>
<div class="modal-footer customer_submit">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" id="add_customer" class="btn btn-base">@lang('layout.save')</button>
</div>
{!! Form::close() !!}
<script src="{{asset('public/admin_layout/js/Modules/Task/store_task.js')}}?v={{ $version }}"></script>     