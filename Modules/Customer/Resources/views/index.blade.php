@extends('layouts.admin.admin_layout')
@section('css')
<link rel="stylesheet" href="{{asset('public/admin_layout/plugins/datatables/jquery.dataTables.min.css')}}?v={{ $version }}">
<link rel="stylesheet" href="{{asset('public/admin_layout/css/chat.css')}}?v={{ $version }}">
<link href="{{asset('public/admin_layout/plugins/daterangepicker/daterangepicker.css')}}?v={{ $version }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="content" id="ajaxview">
	<div class="row">
		<div class="col-lg-12 mb-3" id="statistics">

		</div>
		<div class="col-lg-12">
			<div class="record-selection-table">
				<div class="p-4 bg-white rounded mb-4">
					<div class="table_basic">
						<div class=" text-right">
							<div class="d-inline float-left my-2">
								<i class="fas fa-table"></i>
								@lang('customers.customer')
							</div>
							<div class="d-inline card_buttons">
					
								
								    @if(\Auth::User()->can('export',app('Modules\Customer\Entities\Customer')))
								    <div class="dropdown d-inline">
									<button type="button" class="btn btn-base btn-icon-sm dropdown-toggle btn-toggle-none mb-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-long-arrow-alt-down"></i>
										@lang('layout.export')<i class="fs-11 fas fa-chevron-down"></i>
									</button>
								
									
									<div class="dropdown-menu dropdown-menu-right export_data">
										<ul class="">
											<li class="">
												<span class="ml-2">@lang('layout.cap')</span>
											</li>
											<li class="printMe">
												<a href="{{route('customer.print_file')}}" target="_blank" class="">
													<i class=""></i>
													<span class="">@lang('layout.print')</span>
												</a>
											</li>
											<li class="export_file">
												<a href="{{route('customer.export_excel_file')}}" class="">
													<i class=""></i>
													<span class="">@lang('layout.excel')</span>
												</a>
											</li>
											<li class="export_file">
												<a href="{{route('customer.export_csv_file')}}" class="">
													<i class=""></i>
													<span class="">@lang('layout.csv')</span>
												</a>
											</li>
											<li>
												<a href="{{route('customer.export_pdf_file')}}" target="_blank" class="" >
													<i class=""></i>
													<span class="">@lang('layout.pdf')</span>
												</a>
											</li>
										</ul>
									</div>
								</div> 
								@endif
								  @if(\Auth::User()->can('add',app('Modules\Customer\Entities\Customer')))
											<div class="dropdown d-inline import_data">
									<button type="button" class="btn btn-base btn-icon-sm dropdown-toggle btn-toggle-none mb-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-long-arrow-alt-up"></i>
										@lang('layout.import')<i class="fs-11 fas fa-chevron-down"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<ul class="">
											<li class="">
												<span class="ml-2">@lang('layout.cap')</span>
											</li>
											<li class="import_file" id="file-id-1">
												<a class="">
													<i class=""></i>
													<span class="">@lang('layout.excel')</span>
												</a>
											</li>
											<li class="import_file" id="file-id-2">
												<a class="export-csv">
													<i class="fas fa-file-csv"></i>
													<span class="">@lang('layout.csv')</span>
												</a>
											</li>
										</ul>
									</div>
								</div> 
							
								<button class="btn btn-base mb-2 add_customer"><i class="fas fa-plus"></i> @lang('customers.new_customer')</button>
								@endif
							</div>
								
						</div>
						<hr>
						<div class="table-responsive">
							<table class=" table table-bordered table-hover mb-3" id="myTable">
								<thead>
									<tr>
										<th class="p-3 bg-none"><input type="checkbox"></th>
                                        <th>@lang('users.name')</th>
                                        <th>@lang('users.e-mail')</th>
                                        <th>@lang('users.country')</th>
                                        <th>@lang('users.phone_number')</th>
                                        <th class="p-3">@lang('users.status')</th>
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
<script src="{{asset('public/admin_layout/js/jquery.datatables.min.js')}}?v={{ $version }}"></script>
<script src="{{asset('public/admin_layout/js/Modules/Customers/index.js')}}?v={{ $version }}"></script>
@endsection
