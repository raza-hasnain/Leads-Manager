<div id="tabs3-1" class="container tab-pane active">
            <div class="row" id="pusher_settings">
              <div class="col-md-12">
                <div>
                  <div>
                    <div class="card-title">
                      @lang('settings.edit_user')
                    </div>
                    <hr>
                  </div>
                  <div class="card-block  basic-forms ">
                      {!!Form::open(['route'=>array('settings.edit_user',$user->id),'id'=>'add-form']) !!}
                      <div class="form-group row pt-2">
                        
                           <label class="col-sm-3 col-form-label text-left">@lang('layout.name') @required</label>
                          <div class="col-sm-6"> 
                             <input id="name" type="text" class="form-control" name="name"  placeholder="@lang('layout.name')" required value="{{clean($user->name)}}">
                            
                          </div>
                      </div>
                       
                      
                 
                      <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">@lang('layout.email') @required </label>
                         <div class="col-sm-6">
                         <input id="email" type="email" class="form-control" name="email"  placeholder="@lang('layout.please_enter_your') @lang('layout.email') @lang('layout.address')" value="{{clean($user->email)}}" readonly>
                         
                          </div>
                      </div>
                       <div class="form-group col-12 row pt-2">
                        <label class="col-sm-3 col-form-label text-left">@lang('settings.role_name') @required</label>
                         <div class="col-sm-6">
                           
                          <select type="text"  name="role_id" class="form-control m-input m-input--solid" placeholder="">
                <option value="">@lang('layout.select')</option>
                    @php echo get_option($roles,'id','name',$user->role_id) @endphp
            </select>
                          </div>
                      </div>
                        <div class="form-group col-12 row pt-2">
                        <label class="col-sm-3 col-form-label text-left">@lang('settings.status') @required</label>
                         <div class="col-sm-6">
                          
                          <select type="text"  name="status" class="form-control m-input m-input--solid" placeholder="">
                <option value="">@lang('layout.select')</option>
                    <option value="1" {{ $user->status == 1 ? 'selected' : "" }}>@lang('layout.active')</option>
                  <option value="0" {{ $user->status == 0 ? 'selected' : "" }}>@lang('layout.inactive')</option>
            </select>
                          </div>
                      </div>
                   
                      <div class="form-group row pt-2 Submit">
                        <div class="col-sm-9">
                      <span type="button" id="Submit_pusher_setting" class="btn btn-base pull-right">@lang('layout.submit')</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="offset-4 mb-3 group-end">
                        
                        <a class="btn btn-base btnnext "  data-toggle="pill" href="#v-pills-paypalconfig" id="next-user_list" id="next-user_list">@lang('layout.next')</a>
                      </div>

                    </div>
                    </form>
                  </div>
                </div>           
              </div>
            </div>
          </div>
          <script src="{{asset('public/admin_layout/js/Modules/Settings/add_user.js')}}?v{{$version}}"></script>
        