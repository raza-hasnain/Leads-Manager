@extends('layouts.admin.admin_layout')
@section('css')
  <!-- Settings PAGE PLUGINS --> 
  <link href="{{asset('public/admin_layout/plugins/bootstrap-toggle/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<!-- Settings Page Elements --> 
<div class="content">
  <!--row-->
  <div class=" row">
    <div class="col-md-12">
   
      <!-- Tab panels -->
        <div class=" float-left w-89">
          <div id="tabs3-1" class="container-fluid tab-pane active">
            <div class="row">
              <div class="col-md-6">
                <div class="card" data-sortable="true">
                  <div class="card-header">
                    <div class="card-title">
                      @lang('facebookpost.app_setting')
                    </div>
                  </div>
                  <div class="card-block p-3 basic-forms">
                    {!!Form::open(['route'=>array('facebook.settings'),'id'=>'add-form']) !!}
                  
                      <div class="form-group">
                        @if(isset($appinfo->id))
                        <input type="hidden" name="id" value="{{clean($appinfo->id)}}">
                        @endif
                        <input type="text" class="form-control" name="app_id" placeholder="@lang('facebookpost.write_your_app_id')" value="{{isset($appinfo->app_id) ? clean($appinfo->app_id):''}}">
                      </div>
                      <div class="form-group input-group">
                        <input type="text" data-toggle="tooltip" title="@lang('facebookpost.write_your_app_key')" class="form-control {{isset($appinfo->app_key) ? 'pw':''}}"  name="app_key" placeholder="@lang('facebookpost.write_your_app_key')" value="{{isset($appinfo->app_key) ? clean($appinfo->app_key):''}}">
                         <button class="btn btn-default input-group-addon-right" type="button"><i class="fa fa-eye text-base"></i></button>
                      </div>
                       <div class="form-group input-group">
                        <textarea type="text" data-toggle="tooltip" title="@lang('facebookpost.copy_form_more_option')" class="form-control " rows="4" cols="50" name="scopes">{{isset($appinfo->scopes) ? clean($appinfo->scopes):''}}</textarea>
                         
                      </div>
                      <div class="row">
                         <div class="col-md-12">
                          @lang('facebookpost.for_visit_facebook_developer')
                           <a class="btn btn-base mb-2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">@lang('facebookpost.more')</a>
                          <span class="collapse" id="collapseExample">
                              <span class="card card-body">
                          @lang('facebookpost.if_your_app_create_before_05_May_2020_please_used_this')</br> <span class="text-primary">manage_pages,publish_pages,publish_to_groups</span>
                          @lang('facebookpost.or_your_app_create_after_05_May_2020_please_used__this')</br><span class="text-primary">pages_manage_ads,pages_manage_metadata,pages_read_engagement,pages_read_user_content,pages_manage_posts,pages_manage_engagement,publish_to_groups,groups_access_member_info</span >
                          </span>
                          </span>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-base pull-right">@lang('facebookpost.facebook_login')</button>
                    </form>
                  </div>
                </div>           
              </div>
              <!--setting description-->
                 <div class="col-md-6">
                <div class="card" data-sortable="true">
                  <div class="card-header">
                    <div class="card-title">
                      @lang('facebookpost.app_setting_infromation')
                    </div>
                  </div>
                  <div class="card-block p-3 ">
                      <div class="row">
                       <div class="col-md-4 text-base">
                            <div class="">
                           @lang('facebookpost.app_call_back_url'):
                       </div>
                       </div>
                        <div class="col-md-8">
                           {{route('facebook.callback')}}
                       </div>
                       <div class="col-md-4 text-base">
                            <div class="">
                           @lang('facebookpost.app_web_hook_link'):
                       </div>
                       </div>
                        <div class="col-md-8">
                           {{route('facebook.webhook')}}
                       </div>
                       
                       </div>
                  </div>
                </div>           
              </div>
            </div>
          </div>
        
        </div>
      </div>
  </div><!--/row-->
</div>
<!-- End Settings Page Elements --> 
@endsection

@section('js')
  <script src="{{asset('public/admin_layout/plugins/bootstrap-toggle/bootstrap-toggle.min.js')}}?v={{ $version }}"></script>
@endsection