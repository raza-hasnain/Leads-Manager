@extends('layouts.admin.admin_layout')
@section('css')
<link href="{{asset('public/admin_layout/plugins/daterangepicker/daterangepicker.css')}}?v={{ $version }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="content" id="ajaxview">
	<div class="row">
		<div class="col-lg-12 mb-3" id="statistics">
		</div>
		<div class="col-lg-12" >
			<div class="record-selection-table">
				<div class="p-4 bg-white rounded mb-4">
					<div class="table_basic">
						<div class=" text-right">
							<div class="d-inline float-left my-2">
								<i class="fas fa-table"></i>
								@lang('sales.estimates')
							</div>
							<div class="d-inline card_buttons">
								<button class="btn btn-base add_estimate"><i class="fas fa-plus"></i> @lang('sales.new_estimate')</button>
							</div>
						</div>
						<hr>
						<div class="table-responsive">
							<table class=" table table-bordered table-hover mb-3" id="myTable">
								<thead>
									<tr>
										<th class="p-3 bg-none"><input type="checkbox"></th>
                            			<th>@lang("sales.estimate_id")</th>
                            			<th>@lang("layout.amount")</th>
                            			<th>@lang("sales.estimate_to")</th> 
                            			<th>@lang("layout.date")</th>
                            			<th>@lang("layout.expiry_date")</th>
                            			<th>@lang("layout.status")</th>
                            			<th>@lang('layout.actions')</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
@endsection
@section('js')
<script src="{{asset('public/admin_layout/js/Modules/Estimates/index.js')}}?v={{ $version }}"></script>  
@endsection
