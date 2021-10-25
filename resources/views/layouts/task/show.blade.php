                @if(isset($url_id))
                <!-- Main content -->
                <div class="content">
                     
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                          <div class="header-icon">
                              <i class="pe-7s-news-paper"></i>
                          </div>
                          <div class="header-title">
                             
                            <h1>@lang('task.task')</h1>
                          
                         <div class="d-inline card_buttons mb-2">
                <button class="btn btn-base add_task" data-url='{{$url_id[1]}}' data-id='{{$url_id[0]}}'><i class="fas fa-plus"></i> @lang('task.new_task')</button>
              </div>
              
                          </div>
                         
                      </div>
                     
               
                      <!-- page conntent-->
                  <div class="panel panel-bd mb-4 bg-white">
                      <div class="panel-body py-4 px-3">
                          <div class="row">
                              <div class="col-sm-12">
                                   @endif
                                  <div class="table-responsive">
                                      <table class=" table table-bordered table-hover mb-3" id="tasktable">
                                        <thead>
                                          <tr>
                                            
                                              <th>@lang("layout.title")</th>
                                              <th>@lang("layout.priorities")</th>
                                               @if(isset($url_id))
                                              <th>@lang("layout.status")</th>
                                              @endif
                                               
                                              <th>@lang('layout.actions')</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($tasks as $task)
                                          <tr>
                                          <td>{{clean($task->title)}}</td>
                                           <td>{{clean($task->priorities->name)}}</td>
                                             @if(isset($url_id))
                                            <td>{{clean($task->status->name)}}</td>
                                             @endif
                                             <td><div class="dropdown float-left">
                                    <button type="button" class="btn btn-light dropdown-toggle " data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-right"><li><a class="px-2 cp view-task-tr" id="view-tr-{{clean($task->id)}}"><i class="fas fa-eye pr-1"></i>@lang('layout.view_details')</a></li><li><a class="px-2 cp edit-task-tr" id="edit-tr-{{clean($task->id)}}"><i class="fas fa-edit pr-1"></i>@lang('layout.edit_details')</a></li>
                                        </ul></div><button class="btn btn-light delete-task-tr float-left" id="delete-tr-{{clean($task->id)}}"><i class="fas fa-times"></i></button></td>
                                        </tr>
                                          @endforeach

                                        </tbody>
                                      </table>
                                    </div>
                              </div>
                            @if(isset($url_id))
                          </div>
                                                
                       
                      </div>
                     
                  </div>
                    
                </div><!-- /content -->
                @endif

            <script src="{{asset('public/admin_layout/js/Modules/Task/show_task.js')}}?v={{ $version }}"></script> 