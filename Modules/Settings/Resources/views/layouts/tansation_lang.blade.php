
<div id="tabs3-1" class="container tab-pane active">
            <div class="row" id="pusher_settings">
              <div class="col-lg-12">
                <div>
                  <div>
                    <div class="card-title">
                      @lang('settings.add_phrase')
                    </div>
                    <hr>
                  </div>
                  <div class="card-block  basic-forms ">
                    <div class="row mt-2 ">
                      <div class="col-lg-4 mb-3 group-add ">
                        <div class="input-group mx-2">
                <input class="form-control rounded-pill py-2 pr-5 mr-1 bg-transparent" type="search"  id="search-inp">
                <span class="input-group-append">
                    <div class="input-group-text border-0 bg-transparent ml-n5"><i class="fa fa-search"></i></div>
                </span>
            </div>
                      </div>
             
                   <div class="col-lg-3 mb-3 group-dropdown ">
                    
            <select type="text" id="group" name="group" class="form-control m-input m-input--solid select2" >
              <option value ="" selected>{{ __('translation::translation.group_single') }}</option>
              @foreach($groups as $key => $value)
               <option value="{{clean($value)}}">{{clean($value)}}</option>
               @endforeach
               
            </select>
                   </div>
                  
                  <div class="col-lg-2 mb-3 group-dropdown ">
                    <select type="text" id="language" name="language" class="form-control m-input m-input--solid select2" >
               <option value ="" selected>{{ __('translation::translation.locale')}}</option>
               @foreach($languages as $key => $value)
               <option value="{{clean($key)}}">{{clean($value)}}</option>
               @endforeach

            </select>
                  </div>
                  
                    <div class="col-lg-3 mb-3 group-add "><a class="btn btn-base text-white " id="add_new_language" >@lang('settings.add_phrase')</a></div>
                  </div>
                      <div class="table-responsive p-4">
              <table class=" table table-bordered table-hover mb-3" id="dataTableExample1">
                <thead>
                  <tr>
                   
                                         <tr>
                                <th class="w-1/5 uppercase font-thin">{{ __('translation::translation.group_single') }}</th>
                                <th class="w-1/5 uppercase font-thin">{{ __('translation::translation.key') }}</th>
                                <th class="uppercase font-thin">{{ config('app.locale') }}</th>
                                <th class="uppercase font-thin">{{ $language }}</th>
                            </tr>
                                        
                  </tr>

                </thead>
                <tbody id="tbody">
                  @php $i=0; @endphp 
                  @foreach($translations as $type => $items)
                                
                                @foreach($items as $group => $translations)

                                    @foreach($translations as $key => $value)

                                        @if(!is_array($value[config('app.locale')]))
                                            <tr>
                                                <td id="group-{{$i}}">{{ $group }}</td>
                                                  <td id="key-{{$i}}">{{ $key }}</td>
                                                <td>{{ $value[config('app.locale')] }}</td>
                                                <td class="data-text">
                                                  
                                                  <span class="" id="show-{{$i}}"><i class="fas fa-edit view-tr" id="value-{{$i}}"></i>{{ $value[$language] }}</span>
                                                  <span class="d-none" id="datashow-{{$i}}">
                                                  <textarea class="form-control mb-1 data-text" rows='5' id="data-{{$i}}">{{ $value[$language] }}</textarea>
                                                  <button class="btn btn-base text-white float-right">
                                                    <i class="fas fa-plus  p-1 add-tr" data-id="{{$language}}" id="add-{{$i}}"></i>
                                                  </button>
                                                  <button class="btn btn-base text-white float-right mr-2">
                                                    <i class="fas fa-minus  p-1 minus-tr" id="minus-{{$i}}"></i>
                                                  </button>
                                                  </span>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                        @endif

                                    @endforeach

                                @endforeach
                                           
                            @endforeach
                  
                  
                </tbody>
               
              </table>
                <div class="row">
                      <div class="offset-4 mb-3 group-end">
                      <a class="btn btn-danger btnprv mr-2" id="prv-add_language" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.previous')</a>
                        <a class="btn btn-base btnnext" id="next-pusher_settings" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.next')</a>
                      </div>

                    </div>
            </div>
                  </div>
                </div>           
              </div>
            </div>
          </div>
       <script src="{{asset('public/admin_layout/js/Modules/Settings/tansation_lang.js')}}?v{{$version}}"></script>
        