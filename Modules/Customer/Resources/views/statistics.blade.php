<div class="row stat_area">
	<div class="col-sm-6 col-md-4 col-lg-2">
		<div class="statistic-box dash">
			<i class="ti-user text-base statistic_icon"></i>
			<div class=small>@lang('customers.total_customer')</div>
			<h2><span class=count-number>{{clean($total)}}</span></h2>
		</div>
	</div>
	<div class="col-sm-6 col-md-4 col-lg-2">
		<div class="statistic-box dash">
			<i class="ti-face-smile text-success statistic_icon"></i>
			<div class=small>@lang('customers.active_customer')</div>
			<h2><span class="count-number">{{ isset($statuscount['1']) ? $statuscount['1'] : '0' }}</span><span class="slight"><i class="fa fa-play fa-rotate-90 c-white invisible "> </i> {{ isset($statuscount['1']) ? number_format($statuscount['1']/$total * 100,2): '0' }}%</span> </h2>
		</div>
	</div>
	<div class="col-sm-6 col-md-4 col-lg-2">
		<div class="statistic-box dash">
			<i class="ti-face-sad text-danger statistic_icon"></i>
			<div class=small>@lang('customers.inactive_customer')</div>
			<h2><span class=count-number>{{ isset($statuscount['0']) ? $statuscount['0'] : '0' }}</span><span class=slight><i class="fa fa-play fa-rotate-90 c-white invisible"> </i>{{ isset($statuscount['0']) ? number_format($statuscount['0']/$total * 100,2): '0' }}%</span></h2>
		</div>
	</div>
	@forelse($sources as $source )
	<div class="col-sm-6 col-md-4 col-lg-2">
		<div class="statistic-box dash">
			<i class="{{clean($source->icon)}} statistic_icon"></i>
			<div class=small>{{clean($source->name)}} Contacts</div>
			<h2><span class="count-number">{{clean($source->customers_count)}}</span><span class="slight"><i class="fa fa-play fa-rotate-90 c-white invisible "> </i> @if($source->customers_count >0){{number_format($source->customers_count/$total * 100,2)}}% 

			@else 0% @endif</span> </h2>
		</div>
	</div>
	@empty
	@endforelse
</div>