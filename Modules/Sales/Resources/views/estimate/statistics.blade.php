<div class="row stat_area">
	<div class="col-sm-6 col-md-4 col-lg-2">
		<div class="statistic-box dash">
			<i class="ti-layers-alt text-base statistic_icon"></i>
			<div class=small>@lang('sales.estimate_total')</div>
			<h2><span class=count-number>{{clean($total)}}</span></h2>
		</div>
	</div>
	@forelse($statuses as $status )
	<div class="col-sm-6 col-md-4 col-lg-2">
		<div class="statistic-box dash">
			<i class="{{clean($status->icon)}} statistic_icon"></i>
			<div class=small>{{clean($status->name)}}</div>
			<h2><span class="count-number">{{clean($status->estimates_count)}}</span><span class="slight"><i class="fa fa-play fa-rotate-90 c-white invisible "> </i> @if($status->estimates_count >0){{number_format($status->estimates_count/$total * 100,2)}}% 
			@else 0% @endif</span> </h2>
		</div>
	</div>
	@empty
	@endforelse
</div>