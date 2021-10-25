

            <div>
                <p><strong>@lang('layout.hi') {{clean($request->name)}},</strong></p>
                                        <p><span>{{clean($request->body)}}</span></p>
                                       
                                       @if($request->has('link'))
                                       <p><span>@lang('layout.please_check_this_link_for_information'):</span> <a href="{{clean($request->link)}}" target="_blank">@lang('layout.see_more')</a></p>
                                       @endif
                                        @if($request->has('type') && $request->type !='1')
                                        <p><span>@lang('layout.please_check_attachment')</span></p>
                                        @endif
                                        <div><strong>@lang('layout.regards'),</strong></div>
                                        <div><strong>{{Auth::user()->name}}</strong></div>
                                        <hr>
              </div>
