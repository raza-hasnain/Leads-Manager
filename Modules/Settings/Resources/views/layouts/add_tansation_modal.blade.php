{!!Form::open(['route'=>'settins.translation_add','id'=>'country-update-form']) !!}
<div class="modal-header">
    <h5 class="modal-title">@lang('settings.add_language')</h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">

    
    <div class="form-group m-form__group row">
        <div class="col-lg-12">
            <label class="">
                @lang('settings.group') 
            </label>

            <!-- used Wrong way -->
            <select type="text" name="group" class="form-control m-input m-input--solid select2" >
               <option value="" selected>----</option>
              @foreach($groups as $key => $value)
               <option value="{{clean($value)}}">{{clean($value)}}</option>
               @endforeach
               
            </select>
        </div>

    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-12">
            <label class="">
                {{ __('translation::translation.key') }} @required
            </label>
            <input type="text" name="key" class="form-control m-input m-input--solid" placeholder="@lang('settings.key')">
        </div>
       
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-12">
            <label class="">
                           @lang('settings.value') @required 
            </label>
            <input type="text" name="value" class="form-control m-input m-input--solid" placeholder="@lang('settings.value') ">
        </div>
     
    </div>
</div>
<div class="modal-footer country_submit">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" id="add_country" class="btn btn-base">@lang('layout.save')</button>
</div>
{!! Form::close() !!}

<script src="{{asset('public/admin_layout/js/Modules/Settings/add_lang_modal.js')}}?v={{ $version }}"></script>  
