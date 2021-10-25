{!!Form::open(['route'=>array('settings.role_config'),'id'=>'add-form']) !!}
<div id="tabs3-1" class="container tab-pane active">
            <div class="row" id="pusher_settings">
              <div class="col-md-12">
                <div>
                  <div>
                    <div class="card-title">
                      @lang('settings.roles_config')
                    </div>
                    <hr>
                  </div>
                  <div class="card-block  basic-forms ">
                    <div class="row mt-2 mr-3">
                    <div class="col-12 mb-3 group-add "><a class="btn btn-base text-white cursor-pointer float-right" id="add_role" >@lang('settings.add_new_role')</a></div>
                      <div class="form-group col-12 row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.role_name') @required
                          </label>
                         <div class="col-sm-6">
                           
                          <select type="text"  name="role_id" class="form-control m-input m-input--solid" placeholder="">
                <option value="">@lang('layout.select') </option>
                    @php echo get_option($roles,'id','name') @endphp
            </select>
                          </div>
                      </div>
                   
                    @foreach($modulesName as $modulesName)
                    <div class="col-lg-6 mb-3">
                      <div class="card-header row ml-3">
                      <div class="col-8 card-title">
                        {{__('menu.'.$modulesName->display_name)}}
                      </div>
                      <div class="col-4">
                        <div class="float-right shedule_check">
      <input type="checkbox" class="check_input" name="module_id[]" id="module-{{$modulesName->id}}" data-onstyle="base" data-offstyle="danger" data-toggle="toggle" data-size="small" value="{{$modulesName->id}}">
    </div>
                      </div>
                    </div>
                    
                      <div class="card-block  basic-forms row ml-3">
                        @foreach($modulesName->permissions as $permission)
                        <div class="col-8 py-1 border-1">
                          {{ __('permission.'.$permission->display_name)}}
                        </div>
                         <div class="col-4 py-2">
                                         <div class="float-right shedule_check pr-3">
      <input type="checkbox" name="permission_id[]"  data-onstyle="base" class="permission-{{$modulesName->id}}" data-offstyle="danger" data-toggle="toggle" data-size="small" value="{{$permission->id}}" disabled
      >
    </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                    @endforeach
                   

                  </div>
                    <div class="form-group row pt-2 Submit">
                        <div class="col-sm-10">
                      <span type="button" id="Submit_pusher_setting" class="btn btn-base pull-right">@lang('layout.submit')</span>
                      </div>
                    </div>
                  
                   <div class="row">
                      <div class="offset-4 mb-3 group-end">
                       <a class="btn btn-danger btnprv mr-2" id="prv-assign_user_role_list" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.previous')</a>
                        <a class="btn btn-base btnnext" id="next-translation_language" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.next')</a>
                      </div>

                    </div>
                  </div>
                </div>           
              </div>
            </div>
          </div>
            {!! Form::close() !!}
            <script src="{{asset('public/admin_layout/js/Modules/Settings/pusher_settings.js')}}?v{{$version}}"></script>
            
        