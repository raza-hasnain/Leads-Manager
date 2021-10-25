{!!Form::open(['route'=>'leads.sourceedit','id'=>'country-update-form']) !!}
<div class="modal-header">
    <h5 class="modal-title">@lang('settings.source')</h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">

    
    <div class="form-group row pt-2">
                        
                           <label class="col-lg-3 col-form-label text-left">
                            @lang('layout.name') @required
                          </label>
                          <div class="col-lg-6"> 
                          @if(isset($status)) <input type="hidden" name="id" value="{{clean($status->id)}}"> @endif
                             <input id="name" type="text" class="form-control" name="name"  placeholder="@lang('layout.name')" required @if(isset($status)) value="{{clean($status->name)}}" @endif>
                            
                          </div>
                      </div>
                        <div class="form-group row pt-2">
                        <label class="col-lg-3 col-form-label text-left">
                            @lang('layout.icon') @required
                          </label>
                         <div class="col-lg-6">
                         <div id="iconpicker" role="iconpicker"></div>
                         
                          </div >
                          <div class="col-lg-3 row icon_box">
                            <input type="radio" name="color" class="col-3" value=""> <span class="col-7 "><i class="hvr-buzz-out fas fa-bold"></i></span>
                            <input type="radio" name="color" class="col-3" value="text-secondary"> <span class="col-7 text-secondary"><i class="hvr-buzz-out fas fa-bold"></i></span>
                              
                         
                            <input type="radio" name="color" class="col-3" value="text-danger"> <span class="col-7 text-danger"><i class="hvr-buzz-out fas fa-bold "></i></span>
                            <input type="radio" name="color" class="col-3" value="text-success"> <span class="col-7 text-success"><i class="hvr-buzz-out  fas fa-bold "></i></span>
                            <input type="radio" name="color" class="col-3" value="text-base"> <span class="col-7 text-base"><i class="hvr-buzz-out  fas fa-bold "></i></span>
                            <input type="radio" name="color" class="col-3" value="text-primary"> <span class="col-7 text-primary"><i class="hvr-buzz-out  fas fa-bold "></i></span> 
                          </div>
                      </div>

<div class="modal-footer country_submit">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button" id="add_country" class="btn btn-base">@lang('layout.save')</button>
</div>
{!! Form::close() !!}

<script src="{{asset('public/admin_layout/js/Modules/Settings/add_lang_modal.js')}}?v={{ $version }}"></script>  
