  
                <!-- Main content -->
                <div class="content">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                          <div class="header-icon">
                              <i class="pe-7s-news-paper"></i>
                          </div>
                          <div class="header-title">
                             
                            <h1>@lang('reminder.reminders')</h1>
                           
                         <div class="d-inline card_buttons mb-2">
                <button class="btn btn-base add_task" data-url='{{$url_id[1]}}' data-id='{{$url_id[0]}}'><i class="fas fa-plus"></i> @lang('reminder.new_reminder')</button>
              </div>
                          </div>
                         
                      </div>
                      
               
                      <!-- page conntent-->
                  <div class="panel panel-bd mb-4 bg-white">
                      <div class="panel-body py-4 px-3">
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="table-responsive">
                                      <table class=" table table-bordered table-hover mb-3" id="reminderTable">
                                        <thead>
                                          <tr>
                                            
                                              <th>@lang("layout.date")</th>
                                              <th>@lang("layout.description")</th>
                                              <th>@lang("layout.status")</th>
                                               
                                              <th>@lang('layout.actions')</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($remider as $remider)
                                          <tr>
                                            <td>{{clean($remider->start_date)}}</td>
                                            <td>{{clean($remider->description)}}</td>
                                             <td>{{clean($remider->user->name)}}</td>
                                             <td>
                                               <div class="dropdown float-left">
                                    <button type="button" class="btn btn-light dropdown-toggle " data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-right"><li><a class="px-2 cp view-reminder-tr" id="view-tr-{{clean($remider->id)}}"><i class="fas fa-eye pr-1"></i>@lang('layout.view_details')</a></li><li><a class="px-2 cp edit-reminder-tr" id="edit-tr-{{clean($remider->id)}}"><i class="fas fa-edit pr-1"></i>@lang('layout.edit_details')</a></li>
                                        </ul></div><button class="btn btn-light delete-reminder-tr float-left" id="delete-tr-{{clean($remider->id)}}"><i class="fas fa-times"></i></button>
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
                    
                </div><!-- /content -->

            <script src="{{asset('public/admin_layout/js/Modules/Reminder/show_reminder.js')}}?v={{ $version }}"></script> 