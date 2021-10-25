 <!-- Main content -->
                <div class="content">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                          <div class="header-icon">
                              <i class="pe-7s-news-paper"></i>
                          </div>
                          <div class="header-title">
                             
                            <h1>@lang('note.notes')</h1>
                           
                         <div class="d-inline card_buttons mb-2">
                
              </div>
                          </div>
                         
                      </div>
               
                      <!-- page conntent-->
                  <div class="panel panel-bd mb-4 bg-white">
                      <div class="panel-body py-4 px-3">
                          <div class="row">
                              <div class="col-sm-12">
                                 {!!Form::open(['route'=>array('note.store'),'id'=>'note-add-form']) !!}
                 
                                      <div class="form-group m-form__group row">
                                        <div class="col-md-12">
                                            <label>
                                                @lang('note.notes') @required
                                            </label>
                                           <input type="hidden" name="module_id" value="{{clean($modul_id)}}">
                                            <input type="hidden" name="module_member_id" value="{{$modul_member_id}}">
                                            @if($module_type !=null)
                                            <input type="hidden" name="member_type" value="{{clean($module_type)}}">
                                            @endif
                                            <textarea class="form-control m-input" name="description" rows="3" placeholder="@lang('layout.description')"></textarea>
                                              </div>
                                            <div class="col-md-12 customer_submit">
                                                <button type="button" class="btn btn-success mt-2 float-right" id="add_note">@lang('layout.save')</button>
                                                
                                        </div>
                                     </div>
                                </div>
                             {!! Form::close() !!}
                            
                          </div>
                              <!-- Main content -->
                   
                            

                                  <div class="card-block p-3 pl-5">
                                       <ul class="activity-list activity-data overflow-auto" id="note">
                                        @foreach($notes as $note)
                                            <li class=activity-purple>
                                                <small class=text-muted>{{clean($note->user->name)}}</small>
                                                <small class="float-right">
                                                  <a class="btn btn-primary-soft btn-sm mr-1 edit-tr" id="edit-tr-{{clean($note->id)}}"><i class="fas fa-edit text-primary"></i></a>
                                                  <a class="btn btn-danger-soft btn-sm delete-tr cursor-pointer" id="delete-tr-{{clean($note->id)}}"><i class="far fa-trash-alt text-danger"></i></a>
                                                </small>
                                                <p class="fs-13 mb-1">{{clean($note->description)}}</p>
                                            </li>
                                            @endforeach
                                        </ul>
                                  </div>
                   
           
                                     
                       
                      </div>
                     
                  </div>
                    
                </div><!-- /content -->

            <script src="{{asset('public/admin_layout/js/Modules/Task/show_task.js')}}?v={{ $version }}"></script> 

