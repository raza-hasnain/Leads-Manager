<div id="tabs3-1" class="container tab-pane active">
            <div class="row" id="pusher_settings">
              <div class="col-md-12">
                <div>
                  <div>
                    <div class="card-title">
                      @lang('settings.email_config')
                    </div>
                    <hr>
                  </div>
                  <div class="card-block  basic-forms ">
                      {!!Form::open(['route'=>array('settings.email_config'),'id'=>'add-form']) !!}
                      <div class="form-group row pt-2">
                        
                           <label class="col-sm-3 col-form-label text-left">@lang('settings.driver') @required</label>
                          <div class="col-sm-6"> 
                            <input type="hidden"  name="id" value="{{isset($email->id) ? clean($email->id):''}}">
                            <input type="text" class="form-control" name="driver"  placeholder="@lang('settings.driver')" value="{{isset($email->driver) ? clean($email->driver):''}}">
                          </div>
                      </div>
                       
                      
                      <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">@lang('settings.host') @required</label>
                         <div class="col-sm-6">
                           <input type="text" name="host" class="form-control" data-toggle="tooltip" title="Go to pusher app settings to find app key!"  id="exampleName" placeholder="@lang('settings.host')" value="{{isset($email->host) ? clean($email->host):''}}">
                        </div>
                      </div>
                      <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">@lang('settings.port') @required</label>
                         <div class="col-sm-6">
                            <input type="number" name="port" data-toggle="tooltip" title="Go to pusher app settings to find app id!" class="form-control"  placeholder="@lang('settings.port')" value="{{isset($email->port) ? clean($email->port):''}}">
                          </div>
                      </div>
                      <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">@lang('settings.encryption') @required </label>
                         <div class="col-sm-6">
                          <input type="text" name="encryption" data-toggle="tooltip"  class="form-control"  placeholder="@lang('settings.encryption')" value="{{isset($email->encryption) ? clean($email->encryption):''}}">
                          </div>
                      </div>
                       <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.from_address') @required
                          </label>
                         <div class="col-sm-6">
                          <input type="text" name="form_address" data-toggle="tooltip"  class="form-control"  placeholder="@lang('settings.from_address')" value="{{isset($email->form_address) ? clean($email->form_address):''}}">
                          </div>
                      </div>
                       <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.from_name') @required
                          </label>
                         <div class="col-sm-6">
                          <input type="text" name="form_name" data-toggle="tooltip"  class="form-control"  placeholder="@lang('settings.from_name')" value="{{isset($email->form_name) ? clean($email->form_name):''}}">
                          </div>
                      </div>
                        <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.username') @required
                          </label>
                         <div class="col-sm-6">
                          <input type="text" name="username" data-toggle="tooltip"  class="form-control"  placeholder="@lang('settings.username')" value="{{isset($email->username) ? clean($email->username):''}}">
                          </div>
                      </div>
                        <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('layout.password') @required
                          </label>
                         <div class="col-sm-6">
                          <input type="password" name="password" data-toggle="tooltip"  class="form-control"  placeholder="@lang('layout.password')" value="{{isset($email->password) ? clean($email->password):''}}">
                          </div>
                      </div>
                      <div class="form-group row pt-2 Submit">
                        <div class="col-sm-9">
                      <span type="button" id="Submit_pusher_setting" class="btn btn-base pull-right">@lang('layout.submit')</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="offset-4 mb-3 group-end">
                         <a class="btn btn-danger btnprv mr-2" id="prv-pusher_settings" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.previous')</a>
                        <a class="btn btn-base btnnext" id="next-country_setting" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.next')</a>
                      </div>

                    </div>
                    </form>
                  </div>
                </div>           
              </div>
            </div>
          </div>
          <script src="{{asset('public/admin_layout/js/Modules/Settings/pusher_settings.js')}}?v{{$version}}"></script>