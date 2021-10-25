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
			@forelse($estimates as $estimate)
			<tr>
				<td>{{ clean($estimate->title)}}</td>
				<td>{{ clean($estimate->status->name)}}</td>
				<td>{{ clean($estimate->open_date)}}</td>
				<td>{{ clean($estimate->expiry_date)}}</td>
				<td class="view_estimate"><a class="px-2 cursor-pointer view-tr" id="view-tr-{{clean($estimate->id)}}"><i class="fa fa-eye pr-1"></i> View Details</a>
				<a class="px-2" id="link-tr-{{clean($estimate->id)}}" href="{{route('estimate_link',$estimate->estimate_number)}}" target="_blank"><i class="fa fa-envelop pr-1"></i> @lang('sales.estimate')  @lang('layout.link') @lang('layout.view')</a>
				</td>
				<td class="view_estimate" ><span class="btn btn-base copy-link" id="copy-tr-{{clean($estimate->id)}}">@lang('sales.copy_link')</span></td>
			</tr>
			@empty
			<tr><td>@lang('layout.no_data')</td></tr>
			@endforelse
		</tbody>
	</table>
</div>
<script src="{{asset('public/admin_layout/js/Modules/Leads/estimate.js')}}?v={{ $version }}"></script> 
