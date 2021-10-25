 <div class="row">
 <div class="col-md-12 mb-4">
                    <!-- Nav tabs -->
                        <ul class="nav nav-tabs border-bottom-0 float-right" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#setting-1">@lang('layout.status')</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#setting-2">@lang('layout.source')</a>
                          </li>
                        </ul>
                        <!-- Tab panels -->
                       <div class="tab-content  bg-white p-2 pb-3">
                        <div id="setting-1" class="container tab-pane active"><br>
                          <p class="fs-13 mb-1"><strong>@lang('layout.status') </strong></p>
                          <div class="table-responsive p-4">
                              <div class="float-right status p-2"> <a class="btn btn-base text-white cursor-pointer float-right add_status"  >@lang('layout.new_status')</a></div>
              <table class=" table table-bordered table-hover mb-3" id="myTable">
                <thead>
                  <tr>
                   
                                        <th>@lang('users.name')</th>
                                      
                                        
                                        <th>@lang('layout.actions')</th>
                  </tr>

                </thead>
               <tbody>
                @foreach($statuses as $status)
                 <tr>
                   <td>
                     {{clean($status->name)}}
                   </td>
                   
                   <td>
                    <div class="dropdown float-left">
                          <button type="button" class="btn btn-light dropdown-toggle " data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                           
                                            <li><a class="px-2 cp edit-tr" id="edit-tr-{{clean($status->id)}}"><i class="fas fa-edit pr-1"></i> @lang('layout.edit_details')</a></li>
                                          
                                        </ul>
                                </div>
                                <button class="btn btn-light delete-tr float-left" id="delete-tr-{{clean($status->id)}}"><i class="fas fa-times"></i></button>
                     
                   </td>
                 </tr>
                 @endforeach
               </tbody>
              </table>
            </div>
  
                        </div>
                        <div id="setting-2" class="container tab-pane fade"><br>
                          <p class="fs-13 mb-1"><strong>@lang('layout.source') </strong></p>
                          <div class="table-responsive p-4">
                              <div class="float-right source p-2"> <a class="btn btn-base text-white cursor-pointer float-right add_source"  >@lang('layout.new_source')</a></div>
              <table class=" table table-bordered table-hover mb-3 sourcetable" id="myTable">
                <thead>
                  <tr>
                   
                                        <th>@lang('users.name')</th>
                                      
                                        
                                        <th>@lang('layout.actions')</th>
                  </tr>

                </thead>
               <tbody>
                @foreach($sources as $sourc)
                 <tr>
                   <td>
                     {{clean($sourc->name)}}
                   </td>
                   
                   <td>
                    <div class="dropdown float-left">
                          <button type="button" class="btn btn-light dropdown-toggle " data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                           
                                            <li><a class="px-2 cp edit-tr-source" id="edit-tr-source-{{clean($sourc->id)}}" data-value="source"><i class="fas fa-edit pr-1"></i> @lang('layout.edit_details')</a></li>
                                          
                                        </ul>
                                </div>
                                @if(!isset($sourc->status))
                                <button class="btn btn-light delete-tr-source float-left" id="delete-tr-source-{{clean($sourc->id)}}" data-value="source"><i class="fas fa-times"></i></button>
                                @endif
                     
                   </td>
                 </tr>
                 @endforeach
               </tbody>
              </table>
            </div>
                        </div>
                      </div>
                  </div>
</div>

<script src="{{asset('public/admin_layout/js/Modules/Leads/setting.js')}}?v={{ $version }}"></script>  