{!!Form::open(['route'=>'settings.role_add','id'=>'country-update-form']) !!}
<div class="modal-header">
    <h5 class="modal-title">@lang('settings.role')</h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">

    
    <div class="form-group m-form__group row">
        <div class="col-lg-12">
            <label class="">
                @lang('layout.name') 
            </label>

            <!-- used Wrong way -->
            <input type="text" name="name" class="form-control m-input m-input--solid" placeholder="@lang('layout.name') ">
        </div>

    </div>
   
    
</div>
<div class="modal-footer country_submit">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" id="add_country" class="btn btn-base">@lang('layout.save')</button>
</div>
{!! Form::close() !!}

<script src="{{asset('public/admin_layout/js/Modules/Settings/add_lang_modal.js')}}?v={{ $version }}"></script>  
