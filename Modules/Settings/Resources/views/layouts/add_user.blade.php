<div id="tabs3-1" class="container tab-pane mb-3 active">
            <div class="row" id="pusher_settings">
              <div class="col-md-12">
                <div >
                  <div >
                    <div class="card-title">
                      @lang('settings.add_user')
                    </div>
                    <hr>
                  </div>
                  <div class="card-block  basic-forms ">
                      {!!Form::open(['route'=>array('settings.add_user'),'id'=>'add-form']) !!}
                      <div class="form-group row pt-2">
                        
                           <label class="col-sm-3 col-form-label text-left">@lang('layout.name') @required</label>
                          <div class="col-sm-6"> 
                             <input id="name" type="text" class="form-control" name="name"  placeholder="@lang('layout.name')" required autocomplete="name" autofocus>
                            
                          </div>
                      </div>
                       
                      
                      <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">@lang('layout.password') @required</label>
                         <div class="col-sm-6">
                           <input id="password" type="password" class="form-control" name="password" placeholder="******" required autocomplete="new-password">
                        </div>
                      </div>
                      <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">@lang('layout.email') @required</label>
                         <div class="col-sm-6">
                         <input id="email" type="email" class="form-control" name="email"  placeholder="@lang('layout.please_enter_your') @lang('layout.email') @lang('layout.address')" required autocomplete="email">
                         
                          </div>
                      </div>
                       <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">@lang('settings.role_name') @required</label>
                         <div class="col-sm-6">
                           
                          <select type="text"  name="role_id" class="form-control m-input m-input--solid" placeholder="">
                <option value="">@lang('layout.select')</option>
                @php echo get_option($roles,'id','name') @endphp
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
        