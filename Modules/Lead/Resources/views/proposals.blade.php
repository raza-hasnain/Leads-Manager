<div class="table-responsive mt-4">
	<table class="table table-hover mb-3" id="estimates">
		<thead>
			<tr>
				<th>@lang('layout.title')</th>
				<th>@lang('layout.status')</th>
				<th>@lang('layout.date')</th>
				<th>@lang('sales.open_till')</th>
				<th>@lang('layout.actions')</th>
			</tr>
		</thead>
		<tbody>
			@forelse($proposals as $proposal)
			<tr>
				<td>{{ clean($proposal->title)}}</td>
				<td>{{ clean($proposal->status->name)}}</td>
				<td>{{ clean($proposal->open_date)}}</td>
				<td>{{ clean($proposal->expiry_date)}}</td>
				<td class="view_proposal"><a class="px-2 cursor-pointer view-tr" id="view-tr-{{clean($proposal->id)}}"><i class="fa fa-eye pr-1"></i> @lang('layout.view_details')</a>
				<a class="px-2" id="link-tr-{{clean($proposal->id)}}" href="{{route('estimate_link',$proposal->estimate_number)}}" target="_blank"><i class="fa fa-envelop pr-1"></i> @lang('sales.proposal')  @lang('layout.link') @lang('layout.view')</a>
				</td>
					<td class="view_proposal" ><span class="btn btn-base copy-link" id="copy-tr-{{clean($proposal->id)}}">@lang('sales.copy_link')</span></td>
			</tr>
			@empty
			<tr><td>@lang('layout.no_data')</td></tr>
			@endforelse
		</tbody>
	</table>
</div>
<script src="{{asset('public/admin_layout/js/Modules/Leads/proposal.js')}}?v={{ $version }}"></script> 