	<div class="small-card  card lobicard" data-sortable="true">
				<div class="card-header">
					<div class="card-title">
					@lang('facebookpost.page_list')
					</div>
				</div>
				<div class="small-card card-block p-3">
					<div class="skin-square">
						<div class="row">
							<div class="col-sm-12">
								   @forelse($pages as  $page)
								<div class="i-check">
									<input tabindex="9" name="page[]" value="{{ clean($page->id) }}" type="checkbox" >
									<label for="square-checkbox-1" class="label_length" maxlength="20">{{clean($page->name)}}</label>
								</div>

				                  @empty
				                     <div class="row">
							<div class="col-sm-12">
								<button class="btn btn-base add_customer"><i class="fas fa-plus"></i> @lang('facebookpost.link_facebook_page')</button>
							</div>
						</div>                                   
				                @endforelse
								
							</div>
						</div>
						
					</div>
				</div>
			</div>