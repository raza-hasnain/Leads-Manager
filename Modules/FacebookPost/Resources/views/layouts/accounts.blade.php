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
									<a href="{{ route('facebook.fb_timeline', ['page' => 'page','id' => $page->id]) }}">
									<label for="square-checkbox-1" class="label_length" maxlength="20">{{clean($page->name)}}</label>
								</a>
								</div>

				                  @empty
				                     <div class="row">
							<div class="col-sm-12">
								<i class="fas fa-plus"></i> @lang('facebookpost.link_facebook_page')
							</div>
						</div>                                   
				                @endforelse
								
							</div>
						</div>
						
					</div>
				</div>
			</div>

			<div class="small-card  card lobicard" data-sortable="true">
				<div class="card-header">
					<div class="card-title">
					@lang('facebookpost.group_list')
					</div>
				</div>
				<div class="card-block p-3">
					<div class="skin-square">
						<div class="row list_pages">
							<div class="col-sm-12">
								 @forelse($groups as  $group)
								<div class="i-check">
									<a href="{{ route('facebook.fb_timeline', ['page' => 'group','id' => $group->id]) }}">
									<label for="square-checkbox-1" class="label_length" maxlength="20">{{ clean($group->name) }}</label>
									</a>
								</div>
								 @empty
								<div class="row">
							<div class="col-sm-12">
								<i class="fas fa-plus"></i> @lang('facebookpost.link_facebook_page')
							</div>
							<div class="col-sm-6">

							</div>
						</div>
						@endforelse
							</div>
						</div>
						
					</div>
				</div>
			</div>
			
			