

    $('.table').on('click', '.edit-tr', function(){
        "use strict";
      var itemID  = this.id.replace('edit-tr-', '');
      var url= baseUrl+"sales/editcategory/"+itemID;
      getAjaxModal(url);
    });
    
    $('.table').on('click', '.delete-tr', function(){
        "use strict";
        var itemID  = this.id.replace('delete-tr-', '');
        var currentRow=$(this).closest("tr");
      var name= currentRow.find("td:eq(0)").text();
      var content = i18n.layout.delete+" "+i18n.menu.Items+name+'?';
        var confirmtext = i18n.msg.are_you_delete_it+'?';
        var confirmCallback=function(){
        var requestCallback=function(response){
            if(response.status == 'success') {
               toastr.success(i18n.layout.success,{ closeButton: true });
                table.ajax.reload( null, false ); 
                }else{
                toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                }
            }
            var url= baseUrl+"sales/deletecategory/"+itemID;
            ajaxGetRequest(url,requestCallback);
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });
        var table = $('#myTable').DataTable({                
        processing: true,
        serverSide: true,
        searching: false,
        ajax: baseUrl+"sales/categories",
        dom: 'Bfrtip',
        order: [ [0, 'desc'] ],
        columns: [
            {data:'name'},
            {data:'parent_category.name'},
            {data:'action'},
        ],
        columnDefs: [
          { "orderable": false, "targets": 0 }
        ]
    });

/*status*/
     $('.table').on('click', '.edit-tr-status', function(){
         "use strict";
      var itemID  = this.id.replace('edit-tr-status-', '');
      var url= baseUrl+"sales/estimate_statusedit/"+itemID;
      getAjaxModal(url);
    });
    
    $('.table').on('click', '.delete-tr-status', function(){
        "use strict";
        var leadID  = this.id.replace('delete-tr-status-', '');
        var currentRow=$(this).closest("tr");
    	var value= currentRow.find("td:eq(0)").text();
    	var name = $.trim(value);
    	

    	var content = i18n.layout.delete+" "+name+'?';
        var confirmtext = i18n.msg.are_you_delete_it+'?';
        var confirmCallback=function(){
        var requestCallback=function(response){
            if(response.status == 'success') {
                
                 toastr.success(i18n.layout.success,{ closeButton: true });
               
    		     currentRow.remove();  
                }else{
                
              toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                }
            }
            var url= baseUrl+"sales/estimate_deletestatus/"+leadID;
            ajaxGetRequest(url,requestCallback);
           
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });


/*source*/
     $('.table').on('click', '.edit-tr-source', function(){
         "use strict";
      var itemID  = this.id.replace('edit-tr-source-', '');
      var url= baseUrl+"sales/estimate_sourceedit/"+itemID;
      getAjaxModal(url);
    });
    
    $('.table').on('click', '.delete-tr-source', function(){
        "use strict";
        var leadID  = this.id.replace('delete-tr-source-', '');
        var currentRow=$(this).closest("tr");
    	var value= currentRow.find("td:eq(0)").text();
    	var name = $.trim(value);
    	

    	var content = i18n.layout.delete+" "+name+'?';
        var confirmtext = i18n.msg.are_you_delete_it+'?';
        var confirmCallback=function(){
        var requestCallback=function(response){
            if(response.status == 'success') {
                
                 toastr.success(i18n.layout.success,{ closeButton: true });
               
    		     currentRow.remove();  
                }else{
                
              toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                }
            }
            var url= baseUrl+"sales/estimate_deletesource/"+leadID;
            ajaxGetRequest(url,requestCallback);
           
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });
    
    
         $('.table').on('click', '.edit-tr-invoicestatus', function(){
         "use strict";
      var itemID  = this.id.replace('edit-tr-invoicestatus-', '');
      var url= baseUrl+"sales/invoice_statusedit/"+itemID;
      getAjaxModal(url);
    });
    
    $('.table').on('click', '.delete-tr-invoicestatus', function(){
        "use strict";
        var leadID  = this.id.replace('delete-tr-invoicestatus-', '');
        var currentRow=$(this).closest("tr");
    	var value= currentRow.find("td:eq(0)").text();
    	var name = $.trim(value);
    	

    	var content = i18n.layout.delete+" "+name+'?';
        var confirmtext = i18n.msg.are_you_delete_it+'?';
        var confirmCallback=function(){
        var requestCallback=function(response){
            if(response.status == 'success') {
                
                 toastr.success(i18n.layout.success,{ closeButton: true });
               
    		     currentRow.remove();  
                }else{
                
              toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                }
            }
            var url= baseUrl+"sales/invoice_deletestatus/"+leadID;
            ajaxGetRequest(url,requestCallback);
           
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });
    
    
        
         $('.table').on('click', '.edit-tr-paymentsource', function(){
         "use strict";
      var itemID  = this.id.replace('edit-tr-paymentsource-', '');
      var url= baseUrl+"sales/payment_sourceedit/"+itemID;
      getAjaxModal(url);
    });
    
    $('.table').on('click', '.delete-tr-paymentsource', function(){
        "use strict";
        var id  = this.id.replace('delete-tr-paymentsource-', '');
        var currentRow=$(this).closest("tr");
    	var value= currentRow.find("td:eq(0)").text();
    	var name = $.trim(value);
    	

    	var content = i18n.layout.delete+" "+name+'?';
        var confirmtext = i18n.msg.are_you_delete_it+'?';
        var confirmCallback=function(){
        var requestCallback=function(response){
            if(response.status == 'success') {
                
                 toastr.success(i18n.layout.success,{ closeButton: true });
               
    		     currentRow.remove();  
                }else{
                
              toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                }
            }
            var url= baseUrl+"sales/payment_deletesource/"+id;
            ajaxGetRequest(url,requestCallback);
           
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });
    
  $('.itemcategory').on('click', '.addcategory', function(){
      "use strict";
      var url=baseUrl+"sales/createcategory";
      getAjaxModal(url);
    });
    
     $('.status').on('click', '.add_status', function(){
         "use strict";
      var url=baseUrl+"sales/estimate_statusedit";
      getAjaxModal(url);
    });
    
        $('.source').on('click', '.add_source', function(){
            "use strict";
      var url=baseUrl+"sales/estimate_sourceedit";
      getAjaxModal(url);
    });
    
      $('.source').on('click', '.add_invoice_status', function(){
         "use strict";
        
      var url=baseUrl+"sales/invoice_statusedit";
      getAjaxModal(url);
    });
    
        $('.source').on('click', '.add_payment_source', function(){
            "use strict";
      var url=baseUrl+"sales/payment_sourceedit";
      getAjaxModal(url);
    });