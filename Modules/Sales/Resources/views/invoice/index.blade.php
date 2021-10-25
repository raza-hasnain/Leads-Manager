@extends('layouts.admin.admin_layout')
@section('css')
<link href="{{asset('public/admin_layout/plugins/daterangepicker/daterangepicker.css')}}?v={{ $version }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="content" id="ajaxview">
	<div class="row">
		<div class="col-lg-12 mb-3" id="statistics">
		</div>
		<div class="col-md-5" id="remove_invoice_class">
			<div class="record-selection-table">
				<div class="p-4 bg-white rounded mb-4">
					<div class="table_basic">
						<div class=" text-right">
							<div class="d-inline float-left my-2">
								<i class="fas fa-table"></i>
								@lang('menu.Invoice')
							</div>
							<div class="d-inline card_buttons">
								<button class="btn btn-base add_invoice"><i class="fas fa-plus"></i> @lang('invoice.new_invoice')</button>
							</div>
						</div>
						<hr>
						
						<div class="table-responsive">
							<table class=" table table-bordered table-hover mb-3" id="myTable">
								<thead>
									<tr>
										
                            			<th>@lang('menu.Invoice')</th>
                            			<th>@lang("layout.amount")</th>
                            		   
                            			<th>@lang('layout.actions')</th>
									</tr>
								</thead>
								<tbody>
									@foreach($Invoice as $invoice)
									<tr>
									<td class="view-tr text-base cursor-pointer" id="view-tr-{{$invoice->id}}" data-id="{{$invoice->id}}">#00{{clean($invoice->invoice_number)}}</td>
                            			<td>{{clean($invoice->total)}}</td>
                            		
                            			<td>
                            				<div class="dropdown float-left">
                                    <button type="button" class="btn btn-light dropdown-toggle " data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-right"><li><a class="px-2 cp edit-tr" id="edit-tr-{{clean($invoice->id)}}"><i class="fas fa-edit pr-1"></i>@lang('layout.edit_details')</a></li>
                                        </ul></div><button class="btn btn-light delete-tr float-left" id="delete-tr-{{clean($invoice->id)}}"><i class="fas fa-times"></i></button></td>
                            		</tr>
                            			@endforeach

								</tbody>
							</table>
						</div>
						
					</div>
					</div>
				</div>
			</div>

			  <div class="col-md-7 mb-4" id="invoice-remove">
                    <!-- Nav tabs -->
                        <ul class="nav nav-tabs border-bottom-0" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" id="invoice-tab-data" href="#invoice">@lang('invoice.invoice')</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" id="payment-tab" href="#payment">@lang('invoice.payment')</a>
                          </li>
                           <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" id="task-tab" href="#task">@lang('task.task')</a>
                          </li>
                           <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" id="note-tab" href="#note">@lang('note.notes')</a>
                          </li>
                           <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" id="reminder-tab" href="#reminder">@lang('reminder.reminders')</a>
                          </li>
                           <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" id="active-tab" href="#active">@lang('reminder.activites')</a>
                          </li>
                        </ul>
                        <!-- Tab panels -->
                      <div class="tab-content  bg-white p-2 pb-3">
                        <div id="invoice"  class="container tab-pane active">

                        </div>
                        <div id="payment" class="container tab-pane fade"><br>
                    		
                        </div>
                        <div id="task" class="container tab-pane fade"><br>
                    		
                        </div>
                        <div id="note" class="container tab-pane fade"><br>
                    		
                        </div>
                        <div id="reminder" class="container tab-pane fade"><br>
                    		
                        </div>
                           <div id="active" class="container tab-pane fade"><br>
                    		
                        </div>
                      </div>
                  </div>
		</div>	
	</div>

@endsection
@section('js')
<script src="{{asset('public/admin_layout/js/Modules/Invoice/index.js')}}?v={{ $version }}"></script>  
@endsection
