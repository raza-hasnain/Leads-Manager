<div id="tabs3-1" class="container tab-pane active">
            <div class="row" id="pusher_settings">
              <div class="col-md-12">
                <div>
                  <div>
                    <div class="card-title">
                      @lang('settings.role_assign')
                    </div>
                    <hr>
                  </div>
                  <div class="card-block  basic-forms ">
                      {!!Form::open(['route'=>array('settings.role_assign'),'id'=>'add-form']) !!}
                      <div class="form-group row pt-2">
                        
                           <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.role_name') @required
                          </label>
                              <div class="col-sm-6">
                          <select type="text"  name="country_id" class="form-control m-input m-input--solid" placeholder="">
                <option value="">@lang('layout.select')</option>
                    @php echo get_option($roles,'id','name') @endphp
            </select>
                          </div>
                      </div>
                       
                      
                      <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('user.name') @required
                          </label>
                         <div class="col-sm-6">
                          <select type="text"  name="country_id" class="form-control m-input m-input--solid" placeholder="">
                <option value="">@lang('layout.select')</option>
                    @php echo get_option(clean($users),'id','name') @endphp
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