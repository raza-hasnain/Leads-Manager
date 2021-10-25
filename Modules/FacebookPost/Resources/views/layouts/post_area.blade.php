	
			<div class="card mb-2">
				<div class="card-header">
					<div class="card-title mt-2 float-left">
						<i class="ti-facebook text-base statistic_icon"></i> @lang('facebookpost.create_post')
					</div>
					<div class="draft_post float-right">
						
					</div>
				</div>
				<div class="card-block p-3 basic-forms">
					<div class="form-group row mx-2 mb-2">
						<textarea class="form-control-plaintext" name="post_text" id="post_text" rows="3" placeholder="@lang('facebookpost.write_a_post')"></textarea>
                        <div class="image_uploaded mt-2">
                        </div>
					</div>
					<hr>
					<div class="fb_extra mb-2">
						<label for="file-upload" class="custom-file-upload btn btn-base btn-rounded btn-sm">
    						<i class="ti-gallery mr-1"></i>@lang('facebookpost.photo_video')
						</label>
						<input id="file-upload" class="file_upload" name=img[] type="file" multiple="multiple"/>
						
					</div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header">
					<div class="title_left float-left mt-2">
						<i class="ti-timer text-base statistic_icon mr-2"></i>@lang('facebookpost.schedule')
					</div>
					<div class="float-right">
						<input type="checkbox" name="schedule" data-onstyle="base" data-offstyle="danger" data-toggle="toggle" data-size="small">
					</div>
				</div>
				<div class="card-block p-3 basic-forms">
					<div class="input-group">
                        <input id="datetimepick" name="startdate" onkeydown="return false;" class="form-control datetimepick" placeholder="Select a date" onkeypress="return false;" onkeyup="return false;"  ondrop="return false;" onpaste="return false;">
                    </div>
				</div>
				
				<div class="card-block p-3 basic-forms">
					<div class="form-group mx-2 float-right row mb-2 post_area">
			
					<span  id="post" class="btn btn-base btn-rounded ml-2">@lang('facebookpost.post')</span>
		</div>	
				</div>
			</div>
	