 <div class="row">
 <div class="col-md-12 mb-4">
                    <!-- Nav tabs -->
                        <ul class="nav nav-tabs border-bottom-0 float-right" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#setting-1"> @lang('sales.category')</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#setting-2">@lang('layout.proposal_status')</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#setting-3">@lang('layout.proposal_source')</a>
                          </li>
                            <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#setting-4">@lang('layout.invoice_status')</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#setting-5">@lang('layout.payment_source')</a>
                          </li>
                        </ul>
                        <!-- Tab panels -->
  <div class="tab-content  bg-white p-2 pb-3">
      <div id="setting-1" class="container tab-pane active"><br>
          
          <div class="table-responsive p-4">
            <p class="fs-13 mb-1"><strong>@lang('sales.category') </strong></p>
            <div class="float-right itemcategory p-2"> <a class="btn btn-base text-white cursor-pointer float-right addcategory"  >@lang('sales.new_category')</a></div>
              <table class="table table-bordered mb-3" id="myTable">
                <thead>
                  <tr>
                    <th>@lang('users.name')</th>                         
                    <th>@lang('sales.category_name')</th>                          
                    <th>@lang('Actions')</th>
                  </tr>
                </thead>
              </table>
          </div>
        </div>
      <div id="setting-2" class="container tab-pane"><br>
          
            <div class="table-responsive p-4">
              <p class="fs-13 mb-1"><strong>@lang('layout.proposal_status') </strong></p>
              <div class="float-right p-2 status"> <a class="btn btn-base text-white cursor-pointer float-right add_status"  >@lang('layout.new_status')</a></div>
              <table class="table table-bordered table-hover mb-3" >
                <thead>
                  <tr>
                   <th>@lang('users.name')</th>
                  <th>@lang('Actions')</th>
                  </tr>

                </thead>
               <tbody>
                @foreach($statuses as $status)
                 <tr>
                   <td>
                     {{clean($status->name)}}
                   </td>
                   
                   <td>
                    <div class="dropdown float-left">
                          <button type="button" class="btn btn-light dropdown-toggle " data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                           
                                            <li><a class="px-2 cp edit-tr-status" id="edit-tr-status-{{clean($status->id)}}"><i class="fas fa-edit pr-1"></i> @lang('layout.edit_details')</a></li>
                                          
                                        </ul>
                                </div>
                                @if(!isset($status->status))
                                   
                                <button class="btn btn-light delete-tr-status float-left" id="delete-tr-status-{{clean($status->id)}}"><i class="fas fa-times"></i></button>
                                @endif
                     
                   </td>
                 </tr>
                 @endforeach
               </tbody>
              </table>
            </div>
  
                        </div>
      <div id="setting-3" class="container tab-pane fade"><br>
        
        <div class="table-responsive p-4">
          <p class="fs-13 mb-1"><strong>@lang('layout.proposal_source') </strong></p>
          <div class="float-right p-2 source"> <a class="btn btn-base text-white cursor-pointer float-right add_source"  >@lang('layout.new_source')</a></div>
              <table class=" table table-bordered table-hover mb-3">
                <thead>
                  <tr>
                   <th>@lang('users.name')</th>
                 
                  </tr>
                </thead>
               <tbody>
                @foreach($sources as $sourc)
                 <tr>
                   <td>
                     {{clean($sourc->module_name)}}
                   </td>
                 
                 </tr>
                 @endforeach
               </tbody>
              </table>
            </div>
          </div>
           <div id="setting-4" class="container tab-pane fade"><br>
       
        <div class="table-responsive p-4">
             <p class="fs-13 mb-1"><strong>@lang('layout.invoice_status') </strong></p>
          <div class="float-right p-2 source"> <a class="btn btn-base text-white cursor-pointer float-right add_invoice_status"  >@lang('layout.new_invoice_status')</a></div>
              <table class=" table table-bordered table-hover mb-3">
                <thead>
                  <tr>
                   <th>@lang('users.name')</th>
                  <th>@lang('Actions')</th>
                  </tr>
                </thead>
               <tbody>
                @foreach($InvoiceStatus as $InvoiceStatus)
                 <tr>
                   <td>
                     {{clean($InvoiceStatus->name)}}
                   </td>
                  <td>
                    <div class="dropdown float-left">
                     <button type="button" class="btn btn-light dropdown-toggle " data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                      <ul class="dropdown-menu dropdown-menu-right">
                        <li><a class="px-2 cp edit-tr-invoicestatus" id="edit-tr-invoicestatus-{{clean($InvoiceStatus->id)}}" data-value="source"><i class="fas fa-edit pr-1"></i>@lang('layout.edit_details')</a></li>
                      </ul>
                    </div>
                      @if(!isset($InvoiceStatus->status))
                  <button class="btn btn-light delete-tr-invoicestatus float-left" id="delete-tr-invoicestatus-{{clean($InvoiceStatus->id)}}" data-value="source"><i class="fas fa-times"></i></button>
                  @endif
                </td>
                 </tr>
                 @endforeach
               </tbody>
              </table>
            </div>
          </div>
        <div id="setting-5" class="container tab-pane fade"><br>
        
        <div class="table-responsive p-4">
          <p class="fs-13 mb-1"><strong>@lang('layout.payment_source') </strong></p>  
          <div class="float-right p-2 source"> <a class="btn btn-base text-white cursor-pointer float-right add_payment_source"  >@lang('layout.new_payment_source')</a></div>
              <table class=" table table-bordered table-hover mb-3">
                <thead>
                  <tr>
                   <th>@lang('users.name')</th>
                  <th>@lang('Actions')</th>
                  </tr>
                </thead>
               <tbody>
                @foreach($paymentsource as $paymentsource)
                 <tr>
                   <td>
                     {{clean($paymentsource->title)}}
                   </td>
                  <td>
                    <div class="dropdown float-left">
                     <button type="button" class="btn btn-light dropdown-toggle " data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                      <ul class="dropdown-menu dropdown-menu-right">
                        <li><a class="px-2 cp edit-tr-paymentsource" id="edit-tr-paymentsource-{{clean($paymentsource->id)}}" data-value="source"><i class="fas fa-edit pr-1"></i>@lang('layout.edit_details')</a></li>
                      </ul>
                    </div>
                  <button class="btn btn-light delete-tr-paymentsource float-left" id="delete-tr-paymentsource-{{clean($paymentsource->id)}}" data-value="source"><i class="fas fa-times"></i></button>
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



<script src="{{asset('public/admin_layout/js/Modules/Item/category.js')}}?v={{ $version }}"></script> 