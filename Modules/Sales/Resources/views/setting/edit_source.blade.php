{!!Form::open(['route'=>'estimate.add_source','id'=>'country-update-form']) !!}
<div class="modal-header">
    <h5 class="modal-title">@lang('layout.source')</h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">

    
       <div class="form-group row pt-2">
                        
                           <label class="col-lg-3 col-form-label text-left">
                            @lang('layout.name') @required
                          </label>
                          <div class="col-lg-6"> 
                          @if(isset($status)) <input type="hidden" name="id" value="{{$status->id}}"> @endif
                          
                          <select name="lead_status_id" class="form-control">
                          
                @foreach($modulesName as $moduleName) <option  value="{{ clean($moduleName->name).'_'.clean($moduleName->model_name) }}" @if(isset($status) && $status->module_name == $moduleName->name) selected @endif>@lang('menu.'.$moduleName->name)</option> @endforeach
            </select>
                             
                            
                          </div>
                      </div>
                        
                      

   
    
</div>
<div class="modal-footer country_submit">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" id="add_country" class="btn btn-base">@lang('layout.save')</button>
</div>
{!! Form::close() !!}

<script src="{{asset('public/admin_layout/js/Modules/Settings/add_lang_modal.js')}}?v={{ $version }}"></script> 



