<div id="tabs3-1" class="container tab-pane active">
            <div class="row" id="pusher_settings">
              <div class="col-md-12">
                <div>
                  <div>
                    <div class="card-title">
                      @lang('settings.app_settings')
                    </div>
                    <hr>
                  </div>
                  <div class="card-block  basic-forms ">
                      {!!Form::open(['route'=>array('settings.app_setting'),'id'=>'add-form']) !!}
                      <div class="form-group row pt-2">
                        
                           <label class="col-sm-3 col-form-label text-left">
                            @lang('layout.app_name') @required
                          </label>
                          <div class="col-sm-6"> 
                           <input type="text" name="name" class="form-control m-input m-input--solid" placeholder="@lang('organizations.organization_name')" value=" {{isset($organization->name) ? clean($organization->name):''}}">
                          </div>
                      </div>
                       
                      
                      <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('layout.postal_code')
                          </label>
                         <div class="col-sm-6">
                           <input type="number" name="postal_code" class="form-control m-input m-input--solid" placeholder="1234" value="{{clean($organization->postal_code) ?? '' }}">
                        </div>
                      </div>
                      <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('layout.city')
                          </label>
                         <div class="col-sm-6">
                            <input type="text" name="city" class="form-control m-input m-input--solid" placeholder="@lang('layout.city')" value="{{clean($organization->city) ?? ''}}">
                          </div>
                      </div>
                      <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('layout.address')
                          </label>
                         <div class="col-sm-6">
                         <input type="text" name="address" class="form-control m-input m-input--solid" placeholder="@lang('layout.address')" value="{{clean($organization->address) ?? ''}}">
                          </div>
                      </div>
                       <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('country.country') @required
                          </label>
                         <div class="col-sm-6">
                          <select type="text" onchange="changeNumberCode(this.value)" name="country_id" class="form-control m-input m-input--solid" placeholder="">
                <option value="">@lang('layout.select')</option>
                @php echo get_option($country,'id','name', $organization->country_id) @endphp
            </select>
                          </div>
                      </div>
                       <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('country.country_code') @required
                          </label>
                         <div class="col-sm-6">
                          <input type="text" name="phone_code" id="phone_code" readonly class="form-control m-input m-input--solid" placeholder="---" value="{{clean($organization->phone_code)}}">
                          </div>
                      </div>
                        <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                           @lang('layout.phone_number') @required
                          </label>
                         <div class="col-sm-6">
                          <input type="number" name="phone_no" class="form-control m-input m-input--solid" placeholder="@lang('layout.phone_number')" value="{{clean($organization->phone_no) ?? '' }}" >
                          </div>
                      </div>
                        <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.logo')<span class="text-danger">(180*47)</span> 
                          </label>
                         <div class="col-sm-6">
                          <input type="file" name="files" id="file-upload-lo" class="custom-input-file" data-multiple-caption="{count} files selected" multiple="">
                          </div>
                      
                      </div>
                      <div class="form-group row pt-2">
                            <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.view_logo')
                          </label>
                          <div class="col-sm-6 bg-base">
                            <input type="hidden" name="image" id="file-upload-lo-value">
                           <img id="file-upload-lo-img" src="
                            @if(isset($organization->logo)){{
                            asset('public/'.$organization->logo)
                        }}
                        @else
                        {{asset('/public/admin_layout/img/logo.png')}}
                        @endif"
                        alt="Company Logo" height="47" width="180" class="img-fluid">
                          </div>
                      </div>
                       <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.logo_small')<span class="text-danger">(50*47)</span>
                          </label>
                         <div class="col-sm-6">
                          <input type="file" name="files_sm" id="file-upload-sm" class="custom-input-file" data-multiple-caption="{count} files selected" multiple="">
                          </div>
                      
                      </div>
                      <div class="form-group row pt-2">
                            <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.view_logo_small')
                          </label>
                          <div class="col-sm-6 bg-base">
                            <input type="hidden" name="image_sm" id="file-upload-sm-value">
                           <img id="file-upload-sm-img" src="
                            @if(isset($organization->logo_sm)){{
                            asset('public/'.$organization->logo_sm)
                        }}
                        @else
                        {{asset('/public/admin_layout/img/logo-mini.png')}}
                        @endif"
                        alt="Company Logo" height="47" width="50" class="img-fluid">
                          </div>
                      </div>
                       <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.favicon')<span class="text-danger">(50*47)</span>
                          </label>
                         <div class="col-sm-6">
                          <input type="file" name="files_favicon" id="file-upload-fa" class="custom-input-file" data-multiple-caption="{count} files selected" multiple="">
                          </div>
                      
                      </div>
                       <div class="form-group row pt-2">
                            <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.favicon')
                          </label>
                          <div class="col-sm-6">
                            <input type="hidden" name="image_favicon" id="file-upload-fa-value">
                           <img id="file-upload-fa-img" src="
                            @if(isset($organization->logo_sm)){{
                            asset('public/'.$organization->icons)
                        }}
                        @else
                        {{asset('/public/admin_layout/img/favicon.png')}}
                        @endif"
                        alt="Company Logo" height="47" width="50" class="img-fluid">
                          </div>
                      </div>
                       <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.background')<span class="text-danger"></span>
                          </label>
                         <div class="col-sm-6">
                          <input type="file" name="files_background" id="file-upload-bg" class="custom-input-file" data-multiple-caption="{count} files selected" multiple="">
                          </div>
                      
                      </div>
                       <div class="form-group row pt-2">
                            <label class="col-sm-3 col-form-label text-left">
                            @lang('settings.background')
                          </label>
                          <div class="col-sm-6">
                            <input type="hidden" name="image_background" id="file-upload-bg-value">
                           <img id="file-upload-bg-img" src=" {{asset('/public/storage/logo/profile-bg.jpg')}}?v={{Carbon\Carbon::now()}}" height="47" width="50">
                          </div>
                      </div>
                       <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                           @lang('layout.copyright') @required
                          </label>
                         <div class="col-sm-6">
                          <input type="text" name="copy_right" class="form-control m-input m-input--solid" placeholder="@lang('layout.phone_number')" value="{{clean($organization->copy_right) ?? ''}}" >
                          </div>
                      </div>
                       <div class="form-group row pt-2">
                        <label class="col-sm-3 col-form-label text-left">
                           @lang('settings.footer_container') @required
                          </label>
                         <div class="col-sm-6">
                          <input type="text" name="footer_container" class="form-control m-input m-input--solid" placeholder="@lang('layout.phone_number')" value="{{clean($organization->footer_container) ?? ''}}" >
                          </div>
                      </div>
                      <div class="form-group row pt-2 Submit">
                        <div class="col-sm-9">
                      <span type="button" id="Submit_pusher_setting" class="btn btn-base pull-right">@lang('layout.submit')</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="offset-4 mb-3 group-end">
                        <a class="btn btn-danger btnprv mr-2" id="prv-country_setting" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.previous')</a>
                        <a class="btn btn-base btnnext" id="next-time_zone_setting" data-toggle="pill" href="#v-pills-paypalconfig">@lang('layout.next')</a>
                      </div>

                    </div>
                    </form>
                  </div>
                </div>           
              </div>
            </div>
          </div>
          <script src="{{asset('public/admin_layout/js/Modules/Settings/pusher_settings.js')}}?v{{$version}}"></script>
          <script src="{{asset('public/admin_layout/js/Modules/Settings/validation.js')}}?v{{$version}}"></script>