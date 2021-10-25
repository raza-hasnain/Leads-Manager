<div id="tabs3-1" class="container tab-pane active">
            <div class="row" id="pusher_settings">
              <div class="col-md-12">
                <div>
                  <div>
                    <div class="card-title">
                      @lang('settings.modules_setting')
                    </div>
                    <hr>
                  </div>
                  <div class="card-block  basic-forms ">
                      <div class="row">
                          <div class="col-lg-12  m-3">
                    <!-- Nav tabs -->
                        <ul class="nav nav-tabs border-bottom-0 module-setting-tabs" role="tablist">
                          @foreach($modulesName as $modulename)
                          <li class="nav-item modules-setting-tab" data-url="{{clean(strtolower($modulename->name))}}" >
                            <a class="nav-link cursor-pointer" >@lang('menu.'.$modulename->name)</a>
                          </li>
                         @endforeach
                         <li class="nav-item modules-setting-tab" data-url="task" >
                            <a class="nav-link cursor-pointer" >@lang('task.task')</a>
                          </li>
                        </ul>
                      </div>
                        <!-- Tab panels -->
                      <div class="tab-content   pb-3 col-lg-12 " >
                        <div  class="container tab-pane active" id="module-setting">
                          
                       
                        </div>
                      
                      </div>
                  </div>
                    
                     </div> 
                    
                      
                  
                   
                    
                     <div class="row">
                      <div class="offset-4 mb-3 group-end">
                        <a class="btn btn-danger btnprv mr-2" id="prv-country_setting" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.previous')</a>
                        <a class="btn btn-base btnnext" id="next-time_zone_setting" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.next')</a>
                      </div>

                    </div>
                    
                  </div>
                </div>           
              </div>
            </div>
          </div>
          <script src="{{asset('public/admin_layout/js/Modules/Settings/module_setting.js')}}?v{{$version}}"></script>
        