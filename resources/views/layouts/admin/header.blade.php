  <header class="main_header">
    <div class="logo">
      <a href="{{route('home')}}">
          
        <img class="img-fluid logo1 logo1-active" src="@if(isset($company->logo)){{
                            asset('public/'.$company->logo)
                        }}
                        @else
                        {{asset('/public/admin_layout/img/logo.png')}}
                        @endif" alt="">
        <img class="img-fluid logo2 logo2-active" src="@if(isset($company->logo)){{
                            asset('public/'.$company->logo_sm)
                        }}
                        @else
                        {{asset('/public/admin_layout/img/logo-mini.png')}}
                        @endif" alt="">
      </a>
      <div class="d-none" id="baseurl">{{ asset(' ') }}</div>
      <div class="d-none" id="puserkey">{{$_ENV['PUSHER_APP_KEY']}}</div>
      <div class="d-none" id="ap2">{{$_ENV['PUSHER_APP_CLUSTER']}}</div>
    </div>
    <button class="sidebar-toggler-btn mt-4 pt-1 pl-1 bg-transparent text-white border-0 d-none d-md-inline-block"><i class="fas fa-ellipsis-v"></i></button>
    <ul class="custom-navbar">
     
 

      <li>
        <a href="#" class="dropdown-icon" data-toggle="dropdown"><i class="far fa-envelope"></i>
          <span class="badge fadeAnim count_messages" id="count_messages">0</span>
        </a>
        <div class="dropdown-menu dropdown_box message-box">
          <div class="dropdown_box-header">
            <h4 class="d-block text-center"><span class="count_messages">0</span> @lang('layout.new_message')</h4>
          </div>
          <div class="dropdown_box-body">
            <ul id="messages">
            
            </ul>
          </div>
          <div class="dropdown_box-footer">
            <a href="#" class="footer-btn">@lang('layout.see_all_messages')<i class="fas fa-long-arrow-alt-right"></i></a>
          </div>
        </div>
      </li>
      
      <li><a href="#" data-toggle="dropdown"><i class="far fa-user"></i></a>
        <div class="dropdown-menu dropdown_box settings-box">
          <ul>
            <li class="edit_profile" ><a href="#"><span class="pr-2"><i class="far fa-user"></i></span>@lang('layout.user_profile')</a></li>
             
            <li class="logout" ><a id="logout_out" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"><span class="pr-2"><i class="ti-key"></i></span> {{ __('Logout') }}</a></li>
            </ul>
          </div>
        </li>
        <li><a class="d-block d-md-none pt-0 mr-2 sidebar-toggler text-white" ><i class="ti-menu-alt"></i></a></li>

      </ul>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" >
        @csrf
      </form>
    </header>