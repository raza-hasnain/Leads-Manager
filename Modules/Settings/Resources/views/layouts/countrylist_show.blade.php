<div id="tabs3-1" class="container tab-pane active">
            <div class="row" id="pusher_settings">
              <div class="col-md-12">
                <div>
                  <div>
                    <div class="card-title">
                      @lang('country.country')
                    </div>
                    <hr>
                  </div>
                  <div class="card-block  basic-forms ">
                    <div class="row mt-2 mr-3">
                    <div class="col-12 mb-3 group-add "><a class="btn btn-base text-white float-right" id="add_new_country" >@lang('country.add_new_country')</a></div>
                  </div>
                      <div class="table-responsive p-4">
              <table class=" table table-bordered table-hover mb-3" id="myTable">
                <thead>
                  <tr>
                   
                                        <th>@lang('users.name')</th>
                                        <th>@lang('country.iso')</th>
                                        <th >@lang('country.country_code')</th>
                                        <th >@lang('country.min_digits_mobile')</th>
                                        <th >@lang('country.max_digits_mobile')</th>
                                        <th>@lang('Actions')</th>
                  </tr>

                </thead>
               
              </table>
            </div>
              <div class="row">
                      <div class="offset-4 mb-3 group-end">
                         <a class="btn btn-danger btnprv mr-2" id="prv-email_config" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.previous')</a>
                        <a class="btn btn-base btnnext" id="next-app_setting" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.next')</a>
                      </div>

                    </div>
                  </div>
                </div>           
              </div>
            </div>
          </div>
          <script src="{{asset('public/admin_layout/js/Modules/Settings/country_list.js')}}?v{{$version}}"></script>