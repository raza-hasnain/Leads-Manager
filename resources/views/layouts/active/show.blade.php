  
                <!-- Main content -->
                <div class="content">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                          <div class="header-icon">
                              <i class="pe-7s-news-paper"></i>
                          </div>
                          <div class="header-title">
                             
                            <h1>@lang('reminder.activites')</h1>
                           
                         <div class="d-inline card_buttons mb-2">
                
              </div>
                          </div>
                         
                      </div>

                              <div class="card-block p-3 pl-5">
                                 
                                   <ul class="activity-list activity-data overflow-auto">
                                      
                                     @forelse($activities as $activity)
                                        <li class=activity-purple>
                                            <small class=text-muted>{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</small>
                                            <p class="fs-13 mb-1">{{$activity->description}}</p>
                                             <p class="fs-13 mb-1">{!!$activity->getExtraProperty('item')!!}</p>
                                        </li>
                                         @empty
                                                
                                            @endforelse
                                    </ul>
                              </div>
               
       
                    
                </div><!-- /content -->

            <script src="{{asset('public/admin_layout/js/Modules/Task/show_task.js')}}?v={{ $version }}"></script> 