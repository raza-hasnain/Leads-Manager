@php
$routepost = '';
if(isset($route)){
$routepost = $route;
}
@endphp
{!!Form::open(['route'=>$routepost,'id'=>'profile-add-form','enctype' => 'multipart/form-data'])  !!}
<div class="modal-header">
    <h5 class="modal-title">@lang('layout.mail')</h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
 

       <div class="form-group row pt-2">
                       
                        <input type="hidden" class="form-control" name="email_send" value="{{clean($email) ?? ''}}">
                         <input type="hidden" class="form-control" name="name" value="{{clean($name) ?? ''}}">
                           <label class="col-sm-2 col-form-label text-left pr-0">
                            @lang('layout.subject')
                          </label>
                          <div class="col-sm-10 pl-0"> 
                             <input id="name" type="text" class="form-control" name="subject"   placeholder="@lang('layout.please_type') @lang('layout.subject')" required autocomplete="name" autofocus>
                            
                          </div>
                      </div>
                       
                      
                      
                      <div class="form-group row pt-2">
                        <label class="col-sm-2 col-form-label text-left">
                            @lang('layout.body')
                          </label>
                         <div class="col-sm-12 pb-3">
                          <textarea class="form-control" name="body" rows="4"></textarea>
                          </div>
                           @if((isset($estimates) && $estimates->count() >=1) ||(isset($proposal)&& $proposal->count() >=1) || (isset($Invoice) && $Invoice->count() >=1) )
                          <div class="col-sm-6">@lang('layout.attachment')</div>
                          @endif
                          <div class="col-sm-6 row choice">
                             <input type="hidden" id="input-type" class="form-control" >
                             <input type="hidden" id="link-add" class="form-control" >
                            @if(isset($Invoice) && $Invoice->count() >=1)
                               <input id="name" type="radio" name="choice" value="invoice" class="form-control col-sm-1 radio" >
                                
                              <label class="col-sm-3 col-form-label text-left pr-0">
                            @lang('menu.Invoice')
                          </label>
                          @endif
                          @if(isset($estimates) && $estimates->count() >=1)
                           <input id="name" type="radio" name="choice" value="estimate" class="form-control col-sm-1 radio" >
                              
                              <label class="col-sm-3 col-form-label text-left pr-0">
                            @lang('menu.Estimate')
                          </label>
                          @endif
                          @if(isset($proposal)&& $proposal->count() >=1)
                           <input id="name" type="radio" name="choice" value="propsals" class="form-control col-sm-1 radio" >
                              
                              <label class="col-sm-3 col-form-label text-left pr-0">
                            @lang('menu.Propsals')
                          </label>
                          @endif
                          </div>
                           @if(isset($Invoice) && $Invoice->count() >=1)
                        <div class="col-sm-12 row seen d-none" id="invoice">
                         <label class="col-sm-2 col-form-label text-left pr-0">
                            @lang('menu.Invoice')
                          </label>
                          <div class="col-sm-10 pl-0"> 
                           <select type="text"  id="invoice-id"   class="form-control m-input m-input--solid">
                    <option value="">@lang('layout.select')</option>
                     @php echo get_option($Invoice,'id','invoice_number') @endphp
                    </select>
                   </div>
                   </div>
                        @endif
                        @if(isset($estimates) && $estimates->count() >=1)
                        <div class="col-sm-12 row seen d-none" id="estimate">
                         <label class="col-sm-2 col-form-label text-left pr-0">
                            @lang('menu.Estimate')
                          </label>
                          <div class="col-sm-10 pl-0"> 
                           <select type="text" id="estimate-id"  class="form-control m-input m-input--solid">
                    <option value="">@lang('layout.select')</option>
                     @php echo get_option($estimates,'id','title') @endphp
                    </select>
                   </div>
                   </div>
                        @endif
                        
                         @if(isset($proposal)&& $proposal->count() >=1)
                        <div class="col-sm-12 row  seen d-none" id="propsals">
                         <label class="col-sm-2 col-form-label text-left pr-0">
                            @lang('menu.Propsals')
                          </label>
                          <div class="col-sm-10 pl-0"> 
                           <select type="text"  id="propsoals-id" class="form-control m-input m-input--solid">
                    <option value="">@lang('layout.select')</option>
                     @php echo get_option($proposal,'id','title') @endphp
                    </select>
                   </div>
                   </div>
                        @endif
                      </div>
                      
</div>
</div>
<div class="modal-footer profile_submit">
    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('layout.cancel')</button>
    <button type="button"  id="add_profile" class="btn btn-base">@lang('layout.send')</button>
</div>
{!! Form::close() !!}

 <script src="{{asset('public/admin_layout/js/profileSetting.js')}}?v={{ $version }}"></script>  
