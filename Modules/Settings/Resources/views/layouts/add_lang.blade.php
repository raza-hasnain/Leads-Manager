<div id="tabs3-1" class="container tab-pane active">
            <div class="row" id="pusher_settings">
              <div class="col-md-12">
                <div>
                  <div>
                    <div class="card-title">
                      @lang('settings.add_language')
                    </div>
                    <hr>
                  </div>
                  <div class="card-block  basic-forms ">
                    <div class="row mt-2 mr-3 group-lang">
                    <div class="col-12 mb-3 group-add "><a class="btn btn-base text-white float-right" id="add_new_language" >@lang('settings.add_new_language')</a></div>
                       
   
            
            <label class="col-4 offset-4 text-right">
                @lang('layout.active') 
            </label>

           
            <select type="text" name="lang" class="form-control m-input m-input--solid select2 col-4 lang" id="lang">
           
              @foreach($languages as $language)
               <option value="{{clean($language->language)}}" @if($language->language == $_ENV['APP_LANG'])  selected @endif>{{clean($language->name)}}({{clean($language->language)}})</option>
               @endforeach
               
            </select>
      

   
                  </div>
                      <div class="table-responsive p-4">
              <table class=" table table-bordered table-hover mb-3" id="myTable">
                <thead>
                  <tr>
                   
                                        <th>{{ __('translation::translation.language_name') }}</th>
                                        <th>{{ __('translation::translation.locale') }}</th>
                                        <th>@lang('layout.active')</th>
                                        
                  </tr>

                </thead>
                <tbody>
                
                       @foreach($languages as $language)
                            <tr>
                                <td>
                                    {{ clean($language->name) }}
                                </td>
                                <td>
                                    <a href="">
                                        {{ clean($language->language) }}
                                    </a>
                                </td>
                                <td>
                                    <a href="">
                                        @if($language->language == $_ENV['APP_LANG'])  <i class="ti-check text-success statistic_icon"></i> @lang('layout.active') 
                                        
                                        @else
                                        <i class="fas fa-times"></i>
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            
                        @endforeach
                  
                </tbody>
               
              </table>
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
          </div>
          <script src="{{asset('public/admin_layout/js/Modules/Settings/add_lang.js')}}?v{{$version}}"></script>
        