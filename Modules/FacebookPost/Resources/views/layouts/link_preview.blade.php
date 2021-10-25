<!-- Facebook Post Preview Area -->
<div class="card small-card" data-sortable="true">
    <div class="card-header">
        <div class="card-title">
            <span><i class=ti-facebook></i></span>@lang('facebookpost.preview')
        </div>
    </div>
    <div class="card-block">
        <div class="message_inner">
            <div class=" px-2 row">
                <a href="#" class="col-12">
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img class="rounded-circle" src="{{asset('public/admin_layout/img/avatar.png')}}" alt=""></div>
                        <strong class="inbox-item-author">{{ Auth::user()->name }}</strong>
                        <p class="inbox-item-text">Just Now <span><i class="fa fa-globe"></i></span></p>
                    </div>
                </a>
                <span class="col-12" id="preview_text">@lang('facebookpost.write_a_post')</span>
                <div class="fb_media col-12 mt-2" id="photos">
                </div>
                <div class="link_area col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="pull-left">
                                <span id="plink">@lang('facebookpost.url_of_the_post')</span><br>
                                <span class="h5" id="link_title"><b>@lang('facebookpost.title_for_the_post')</b></span><br>
                                <span id="url_desc">@lang('facebookpost.short_decription_for_the_post')</span><br>
                            </div>
                            <div class="pull-right" id="link_button">
                            </div>
                        </div>                	
                    </div>                	
                </div>

                <div class="fb_extra mb-2 col-12">
                    <hr>
                    <span class="ml-4"><i class="ti-thumb-up mr-2"></i>@lang('facebookpost.like')</span>
                    <span class="ml-4"><i class="ti-comment mr-2"></i>@lang('facebookpost.comment')</span>
                  
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Preiew Area -->
