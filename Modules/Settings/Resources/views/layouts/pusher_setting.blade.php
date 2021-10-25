<div id="tabs3-1" class="container tab-pane active">
            <div class="row" id="pusher_settings">
              <div class="col-md-12">
                <div>
                  <div>
                    <div class="card-title">
                      @lang('settings.pusher_settings') @required
                    </div>
                    <hr>
                  </div>
                  <div class="card-block  basic-forms ">
                      {!!Form::open(['route'=>array('settings.pusher_settings'),'id'=>'add-form']) !!}
                      <div class="form-group row pt-2">
                        
                           <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.api_id') @required
                          </label>
                          <div class="col-sm-6"> 
                            <input type="hidden"  name="id" value="{{isset($data->id) ? $data->id:''}}">
                            <input type="text" class="form-control" name="pusher_app_key"  placeholder="Enter Pusher App Key" value="{{isset($data->pusher_app_key) ? clean($data->pusher_app_key):''}}">
                          </div>
                      </div>
                       
                      
                      <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.api_key') @required
                          </label>
                         <div class="col-sm-6">
                           <input type="text" name="pusher_app_secret" class="form-control" data-toggle="tooltip" title="Go to pusher app settings to find app key!"   placeholder="@lang('layout.please_enter_your') @lang('settings.api_key')" value="{{isset($data->pusher_app_secret) ? clean($data->pusher_app_secret):''}}">
                        </div>
                      </div>
                      <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.secret_key') @required
                          </label>
                         <div class="col-sm-6">
                            <input type="text" name="pusher_app_id" data-toggle="tooltip" title="Go to pusher app settings to find app id!" class="form-control"  placeholder="@lang('layout.please_enter_your') @lang('settings.secret_key')" value="{{isset($data->pusher_app_id) ? clean($data->pusher_app_id):''}}">
                          </div>
                      </div>
                      <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.api_cluster') @required
                          </label>
                         <div class="col-sm-6">
                          <input type="text" name="pusher_app_cluster" data-toggle="tooltip" title="Go to pusher app settings to find app id!" class="form-control"  placeholder="@lang('layout.please_enter_your') @lang('settings.api_cluster')" value="{{isset($data->pusher_app_cluster) ? clean($data->pusher_app_cluster):''}}">
                          </div>
                      </div>
                      <div class="form-group row pt-2 Submit">
                        <div class="col-sm-9">
                      <span type="button" id="Submit_pusher_setting" class="btn btn-base pull-right">@lang('layout.submit')</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="offset-4 mb-3 group-end">
                       <a class="btn btn-danger btnprv mr-2" id="prv-translation_language" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.previous')</a>
                        <a class="btn btn-base btnnext" id="next-email_config" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.next')</a>
                      </div>

                    </div>
                    </form>
                  </div>
                </div>           
              </div>
            </div>
          </div>
          <script src="{{asset('public/admin_layout/js/Modules/Settings/pusher_settings.js')}}?v{{$version}}"></script>
        