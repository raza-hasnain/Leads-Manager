<!-- Facebook Posts View Area -->

    @foreach($posts as $post)
    <div class="card-block pb-2">
        <div class="message_inner">
            <div class="message_widgets px-4 row">
                <a href="#" class="col-8">
                    <div class="inbox-item" >
                        <div class="inbox-item-img"><img class="rounded-circle" src="{{asset('public/admin_layout/img/avatar.png')}}" alt=""></div>
                        <strong class="inbox-item-author">{{ clean($post->user->name) }}</strong>
                        <p class="inbox-item-text">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans()  }} <span><i class="fa fa-globe"></i></span></p>
                    </div>
                </a>
                <a href="#" class="col-4">
                    @if($post->page) {{ clean($post->page->name)  }} 
                    @elseif($post->group){{ clean($post->group->name)  }}
                    @else No page @endif
                </a>

                <span class="col-12" id="preview_text">{{ clean($post->message) }} </span>
               
                    <a @if($post->link) href="{{ $post->link}}" @endif>
                         <div class="fb_media col-12 mt-2 media-{{ $post->mediadetails->count() }}" id="photos">
                    @foreach($post->mediadetails as $mediadetails )

                    <img data-lity  class="img-fluid" src="{{ asset("public\storage\media\\".$mediadetails->media->pic_name) }}" alt="">
                    @endforeach
                    
                     </div>
                     </a>
                    @if($post->link)
                      <div class="link_area col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="pull-left">
                                <span id="plink">{{ clean($post->link) }}</span><br>
                                <span class="h5" id="link_title"><b>{{clean($post->title)}}</b></span><br>
                                <span id="url_desc">{{clean($post->description)}}</span><br>
                            </div>
                            <div class="pull-right" id="link_button">
                                    <button type="submit" class="btn btn-base" id="button_link">{{ clean($post->button_type) }}</button>
                            </div>
                         </div>                  
                     </div>                  
                         </div>
                    @endif
               
                <div class="counter col-12">
                    <div class="pull-left">
                        <span><i class="icon_fb fas fa-thumbs-up text-white p-1 mr-1"></i></span>  
                    </div>
                    <div class="pull-right">
                        <span class="ml-4 " ><span id="comments-{{ clean($post->post_id) }}">0 </span>@lang('facebookpost.comment')</span>  
                        
                    </div>
                    
                </div>
                <div class="fb_extra py-2 border-top my-2 col-12">
                    <div class="row col-xm-12 pix">
                        <span class="col-4"><i class="fas fa-thumbs-up text-base mr-2"></i>@lang('facebookpost.like')</span>
                        <span class="col-6"><i class="ti-comment mr-2"></i>@lang('facebookpost.comment')</span>
                      
                    </div>
                </div>
                      <div class="comment_area comment" id="{{$post->post_id}}">
                        
                        <div class="reply_item ml-5" id="reply_item-1">

                        </div>                        
                    </div>
            </div>
        </div>
    </div>
    <hr>
    @endforeach
<script src="{{asset('public/admin_layout/js/Modules/FacebookPost/posts.js')}}?v={{ $version }}"></script>
<!-- End View Area -->

