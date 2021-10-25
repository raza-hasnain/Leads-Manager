<div class="bd-live-chat">
            <header class="chat-header d-flex align-items-center justify-content-between">
                <h4 id="name-{{ clean($id) }}">{{ clean($name) }}</h4>
                <div class="d-flex">
                    <div class="dropdown chat-settings">
                        <button class="btn" data-toggle="dropdown" aria-haspopup="true"><i class="fas fa-cog"></i></button>
                        <div class="dropdown-menu dropdown-menu-right convert">
                            <a href="#" class="dropdown-item convert-id" id="convert-{{clean($id)}}"><i class="fas fa-phone " ></i>@lang('leads.convert_to_lead')</a>
                       
                            <hr>
                        </div>
                    </div>
                    <a href="#" class="btn chat-close"><i class="fas fa-times"></i></a>
                    <a href="#" class="btn chat-toggle">
                        <i class="fas fa-chevron-up"></i>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    
                </div>
            </header>
            <div class="bd-chat" >
                <div class="bd-message-content">
                    <div class="position-relative" id="me"> 
                    @php $i=1;@endphp   
                        @forelse($message as $message)
                        @if($message->send_id == $pageid)
                        <div class="message me">
                            <div class="text-main">
                                <span class="time-ago"><i class="fa fa-clock-o" aria-hidden="true"></i>{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans()  }}</span>
                                <div class="text-group me">
                                    <div class="text me">
                                <p> {{ clean($message->message) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div><!--/.message-->
                        @else
                         <div class="message  ">
                            
                            <div class="text-main">
                                <span class="time-ago"><i class="fa fa-clock-o" aria-hidden="true"></i>{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans()  }}</span>
                                <div class="text-group ">
                                    <div class="text ">
                                <p> {{ clean($message->message) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div><!--/.message-->
                        @if($i==1)
                        <span id="{{clean($message->send_id)}}" class="d-none"> @php $i++; @endphp</span>
                        @endif
                        @endif
                        @empty
                        @endforelse
           
                    </div>
                </div>
                <div class="chat-area-bottom d-flex align-items-center">
                    <form class="position-relative w-100 send_data" >
                        <input class="form-control d-block send-message-sb" id="input-{{clean($id)}}"type="text" placeholder="@lang('layout.type_a_message_here')">
                        
                        <button type="button" class="btn send" id="{{ clean($id) }}" data-id="{{ clean($pageid) }}"><i class="fab fa-telegram-plane" ></i></button>
                    </form>
                     
                </div><!--/.chat area bottom-->
            </div><!--/.chat -->
        </div><!--/.live-chat -->
<script src="{{asset('public/admin_layout/js/Modules/FacebookPost/chat.js')}}?v={{ $version }}"></script>  