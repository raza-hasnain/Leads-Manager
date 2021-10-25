<div id="tabs3-1" class="container tab-pane active">
            <div class="row" id="pusher_settings">
              <div class="col-md-12">
                <div>
                  <div>
                    <div class="card-title">
                      @lang('settings.role_list')
                    </div>
                    <hr>
                  </div>
                  <div class="card-block  basic-forms ">
                    <div class="col-12 mb-3 group-add pt-2"><a class="btn btn-base text-white cursor-pointer float-right" id="add_role" >@lang('settings.add_new_role')</a></div>
                      <div class="table-responsive p-4">
              <table class=" table table-bordered table-hover mb-3" id="myTable">
                <thead>
                  <tr>
                   
                                        <th>@lang('users.name')</th>
                                      
                                        
                                        <th>@lang('Actions')</th>
                  </tr>

                </thead>
               <tbody>
                @foreach($roles as $role)
                 <tr>
                   <td>
                     {{clean($role->name)}}
                   </td>
                   
                   <td>
                    <div class="dropdown float-left">
                          <button type="button" class="btn btn-light dropdown-toggle " data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                          
                                            <li><a class="px-2 cp edit-tr" id="edit-tr-{{$role->id}}"><i class="fas fa-edit pr-1"></i> @lang('layout.edit_details')</a></li>
                                          
                                        </ul>
                                </div>
                                @if($role->id !=1)
                                <button class="btn btn-light delete-tr float-left" id="delete-tr-{{$role->id}}"><i class="fas fa-times"></i></button>
                                @endif
                     
                   </td>
                 </tr>
                 @endforeach
               </tbody>
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
          
         <script src="{{asset('public/admin_layout/js/Modules/Settings/edit_role.js')}}?v{{$version}}"></script>