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
									<input tabindex="9" type="checkbox" name="group[]" value="{{ $group->id }}" >
									<label for="square-checkbox-1" class="label_length" maxlength="20">{{ clean($group->name) }}</label>
								</div>
								 @empty
								<div class="row">
							<div class="col-sm-12">
								<i class="fas fa-plus"></i> @lang('facebookpost.Link_Facebook_Page')
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
			