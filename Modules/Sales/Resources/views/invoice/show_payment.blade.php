        @php 
        $InvoiceDetailsfirst = $InvoiceDetails->first()
        @endphp
                <!-- Main content -->
                <div class="content">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                          <div class="header-icon">
                              <i class="pe-7s-news-paper"></i>
                          </div>
                          <div class="header-title">
                             
                            <h1>@lang('invoice.payment')</h1>
                           
                         <div class="d-inline card_buttons mb-2">@if($show == 0)
                <button class="btn btn-base add_payment"><i class="fas fa-plus"></i> @lang('invoice.new_payment')</button>
                @endif
              </div>
                          </div>
                       
                      </div>
               
                      <!-- page conntent-->
                  <div class="panel panel-bd mb-4 bg-white">
                      <div class="panel-body py-4 px-3">
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="table-responsive">
                                      <table class=" table table-bordered table-hover mb-3" id="paymentTable">
                                        <thead>
                                          <tr>
                                            
                                              <th>@lang("invoice.transaction_id")</th>
                                              <th>@lang("layout.amount")</th>
                                              <th>@lang("invoice.payment_type")</th>
                                               <th>@lang("invoice.due")</th>
                                              <th>@lang('layout.actions')</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                       @foreach($InvoiceDetails->InvoiceDetails as $invoicedetails)
                                       <tr>
                                         <td>
                                           {{clean($invoicedetails->refernce_number)}}
                                         </td>
                                         <td>
                                           {{clean($invoicedetails->amount)}}
                                         </td>
                                         <td>
                                           {{clean($invoicedetails->payment->title)}}
                                         </td>
                                         <td>
                                           {{clean($invoicedetails->due)}}
                                         </td>
                                         <td>
                                           <div class="dropdown float-left">
                                    <button type="button" class="btn btn-light dropdown-toggle " data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-right"><li><a class="px-2 cp view-payment-tr" id="view-tr-{{clean($invoicedetails->id)}}"><i class="fas fa-eye pr-1"></i>@lang('layout.view_details')</a></li>
                                        </ul></div>
                                         </td>
                                       </tr>
                                       @endforeach

                                        </tbody>
                                      </table>
                                    </div>
                              </div>
                            
                          </div>
                                                
                       
                      </div>
                     
                  </div>
                    
                </div><!-- /content -->

            <script src="{{asset('public/admin_layout/js/Modules/Invoice/show_payment.js')}}?v={{ $version }}"></script> 