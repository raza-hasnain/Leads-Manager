{!!Form::open(['route'=>'prioritie.add_status','id'=>'country-update-form']) !!}
<div class="modal-header">
    <h5 class="modal-title">@lang('layout.priorities')</h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">

    
       <div class="form-group row pt-2">
                          <label class="col-md-3 col-form-label text-left">
                            @lang('layout.name') @required
                          </label>
                          <div class="col-md-6"> 
                          @if(isset($status)) <input type="hidden" name="id" value="{{clean($status->id)}}"> @endif
                             <input id="name" type="text" class="form-control" name="name"  placeholder="@lang('layout.name')" required @if(isset($status)) value="{{clean($status->name)}}" @endif>
                            
                          </div>
                          </div> 
   
                        
                      

   
    
</div>
<div class="modal-footer country_submit">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" id="add_country" class="btn btn-base">@lang('layout.save')</button>
</div>
{!! Form::close() !!}

<script src="{{asset('public/admin_layout/js/Modules/Settings/add_lang_modal.js')}}?v={{ $version }}"></script> 



