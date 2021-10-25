<!-- Facebook Post Area		 -->
<div class="card mb-2">
	<div class="card-header">
		<div class="card-title mt-2 float-left">
			<i class="ti-facebook text-base statistic_icon"></i>@lang('facebookpost.create_post')
		</div>
		<div class="draft_post float-right">
			
		</div>
	</div>
	<div class="card-block p-3 basic-forms">
		<div class="form-group row mb-2">
			<textarea class="form-control mx-3" name="post_text" id="post_text" rows="3" placeholder="@lang('facebookpost.write_a_post')"></textarea>
		</div>
		<div class="fb_extra">
			<div class="form-group">
				<input type="url" name="post_link" data-toggle="tooltip" title="@lang('facebookpost.url_of_the_post')  http:// or https://  Example https://bdtask.com" class="form-control" id="post_link" placeholder="Enter Your Link">
			</div>
			<div class="form-group">
                <input type="text" name="post_tile" data-toggle="tooltip" title="For youtube link skip this!!" id="titleofpage" class="form-control" placeholder="@lang('facebookpost.title_for_the_post')">
            </div>
			<div class="form-group">
                <textarea class="form-control" name="post_descrption" data-toggle="tooltip" title="For youtube link skip this!!" id="link_desc" rows="2" placeholder="@lang('facebookpost.short_decription_for_the_post')"></textarea>
            </div>
			<div class="form-group">
				<div class="image_uploaded mt-2">
				</div>
			</div>
            <div class="btn-group mr-2">
				<label for="file-upload" class="custom-file-upload btn btn-base btn-sm">
					<i class="ti-gallery mr-1"></i>Photo/Banner
				</label>
				<input id="file-upload" class="file_upload" type="file"/>            		
            </div>	
			<div class="btn-group">
  				<div class="input-group-prepend">
    				<button class="btn btn-base" type="button">Button</button>
  				</div>
  				<select class="form-control" name="callaction" id="button_select">
    				@foreach($callactions as $callaction)
                            	<option value="{{ $callaction->name }}" >{{ clean($callaction->display_name) }}</option>
                          
                            	 @endforeach
  				</select>

			</div>
		</div>
	</div>
</div>
<div class="card mb-3 shedule">
	<div class="card-header">
		<div class="title_left float-left mt-2">
			<i class="ti-timer text-base statistic_icon mr-2"></i>@lang('facebookpost.schedule')
		</div>
		<div class="float-right shedule_check">
			<input type="checkbox" id="check_input" data-onstyle="base" data-offstyle="danger" data-toggle="toggle" data-size="small">
		</div>
	</div>
	
	<div class="card-block p-3 basic-forms shedule_time d-none">
	<div class="input-group">
			<input id="datetimepick" onkeydown="return false;" class="form-control datetimepick" placeholder="Select a date" onkeypress="return false;" onkeyup="return false;"  ondrop="return false;" onpaste="return false;">
		</div>
	</div>
	<div class="card-block p-3 basic-forms">
		<div class="form-group mx-2 float-right row mb-2 post_area">
			
			<span  id="post" class="btn btn-base btn-rounded ml-2">@lang('facebookpost.post')</span>
		</div>	
	</div>
</div>
<!-- End Post Area -->
