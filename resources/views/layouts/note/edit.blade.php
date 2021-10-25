{!!Form::open(['route'=>array('note.edit',$note->id),'id'=>'task-edit-form']) !!}

<div class="modal-header">

    <h5 class="modal-title">@lang('note.note_edit')</h5>
 <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">

    <div class="form-group m-form__group row">
        <div class="col-lg-12">
            <label>
                @lang('layout.description') @required
            </label>
            <textarea class="form-control m-input" name="description" rows="3" placeholder="@lang('layout.description')">{{clean($note->description)}}</textarea>
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