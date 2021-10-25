@php
$menu=display_menu('admin');

@endphp
<aside class="sidebar-wrapper index3-nav-wrapper">
              <nav class="sidebar-nav">
              <ul class="metismenu" id="menu1">
                      <!-- for Dasboard Modules --> 

              @foreach($menu->parent_items->sortBy('order') as $k=>$item)
              @php $route=(!empty($item->route))?(route($item->route)):''; @endphp
              @if(Auth::user()->can('browse', app($item->model_name)) || is_null($item->model_name))
                @if(!$item->children->isEmpty() )
                       
                          <li class="single-nav-wrapper ">
                      <a class="has-arrow menu-item {{ activeMenu($route)}}" href="#" aria-expanded="false">
                        <span class="left-icon"><i class="{{$item->icon}}"></i></span>
                        <span class="menu-text">@lang('menu.'.$item->title)</span>
                      </a> 

                      <ul class="dashboard-menu">
                          
                      @foreach($item->children as $child)
                       @php $route=(!empty($child->route))?(route($child->route)):''; @endphp
                       @if($child->key ==null || Auth::user()->can($child->key, app($child->model_name)))
                        <li><a href="{{$route}}"><i class="{{$child->icon}}"></i> @lang('menu.'.$child->title) </a></li>
                       @endif
                       
                 
                        @endforeach
                      </ul>
                         </li>

                        @else
                        
                <li class="single-nav-wrapper {{ activeMenu($route)}}">
                  <a class="menu-item {{ activeMenu($route)}}" href="{{$route}}" aria-expanded="false">
                    <span class="left-icon"><i class="{{$item->icon}}"></i></span>
                    <span class="menu-text">@lang('menu.'.$item->title)</span>
                  </a>
                </li>
                @endif
                @endif
                @endforeach
                 
                   
                </ul>
              </nav>
            </aside>