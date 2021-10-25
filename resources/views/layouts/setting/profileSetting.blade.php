{!!Form::open(['route'=>'profileSetting','id'=>'profile-add-form','enctype' => 'multipart/form-data'])  !!}
<div class="modal-header">
    <h5 class="modal-title">@lang('settings.edit_profile')</h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
 

       <div class="form-group row pt-2">
                        
                           <label class="col-sm-3 col-form-label text-right">
                            @lang('layout.name')
                          </label>
                          <div class="col-sm-6"> 
                             <input id="name" type="text" class="form-control" name="name" value="{{clean($user->name)}}"  placeholder="@lang('layout.name')" required autocomplete="name" autofocus>
                            
                          </div>
                      </div>
                       
                      
                      <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-right">
                            @lang('layout.password')
                          </label>
                         <div class="col-sm-6">
                           <input id="password" type="password" class="form-control" name="password"  placeholder="******" required autocomplete="new-password">
                        </div>
                      </div>
                      <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-right">
                            @lang('layout.email')
                          </label>
                         <div class="col-sm-6">
                         <input id="email" type="email" class="form-control"  value="{{clean($user->email)}}" readonly required autocomplete="email">
                         
                          </div>
                      </div>
</div>
</div>
<div class="modal-footer profile_submit">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button"  id="add_profile" class="btn btn-base">@lang('layout.save')</button>
</div>
{!! Form::close() !!}

 <script src="{{asset('public/admin_layout/js/profileSetting.js')}}?v={{ $version }}"></script>  
