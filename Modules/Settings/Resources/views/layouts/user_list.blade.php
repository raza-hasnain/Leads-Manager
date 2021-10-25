<div id="tabs3-1" class="container tab-pane active">
            <div class="row" id="pusher_settings">
              <div class="col-md-12">
                <div>
                  <div>
                    <div class="card-title">
                      @lang('settings.user_list')
                    </div>
                  </div>
                  <hr>
                  <div class="card-block  basic-forms ">
                      <div class="table-responsive p-4">
              <table class=" table table-bordered table-hover mb-3" id="myTable">
                <thead>
                  <tr>
                   
                                        <th>@lang('users.name')</th>
                                        <th>@lang('users.e-mail')</th>
                                        <th >@lang('users.role')</th>
                                        <th >@lang('users.status')</th>
                                        <th>@lang('Actions')</th>
                  </tr>

                </thead>
               
              </table>
            </div>
              <div class="row">
                      <div class="offset-4 mb-3 group-end">
                        <a class="btn btn-danger btnprv mr-2" id="prv-add_user" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.previous')</a>
                        <a class="btn btn-base btnnext" id="next-role_permission" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.next')</a>
                      </div>

                    </div>
                  </div>
                </div>           
              </div>
            </div>
          </div>
          <script src="{{asset('public/admin_layout/js/Modules/Settings/user_list.js')}}?v{{$version}}"></script>
        