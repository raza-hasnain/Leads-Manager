$(document).ready(function(){
	    "use strict";
	    
	    var table = $('#myTable').DataTable({
  "ordering": false
});

  		var url= baseUrl+"sales/invoice/statistics";
    	getAjaxView(url,data=null,'statistics',false,'get');
    	
        var id = $("#myTable tbody tr td:first-child").data("id");
    
        var invoiceurl = baseUrl+"sales/invoice/showinvoice/"+id;
        $("#invoice").attr('data-id',id);

        if(table.data().any()){
        getAjaxView(invoiceurl,data=null,'invoice',false,'get');
        }
        else{
            $("#invoice-remove").remove();
            $('#remove_invoice_class').addClass('col-12');
            $('#remove_invoice_class').removeClass('col-md-5');
        }
        $(document).on('change','#status_id',function(){
        
            var data={"_token": XCSRFTOKEN,status_id: $(this).val()};
       
          var statusurl = baseUrl+"sales/invoice/status/"+$("#invoice").attr('data-id');

          var successcallback = function(a){
            if (a.status == 'success') {
                toastr.success(i18n.menu.Invoice+" "+i18n.msg.update_successfully,  i18n.layout.success,{ closeButton: true });
        }
            if (a.status == 'error') {
                toastr.error(i18n.menu.Invoice+" "+i18n.msg.update_invoice_failed, i18n.layout.error,{ closeButton: true });
        }
          }
           ajaxFormSubmit(statusurl,data,'',successcallback);
        });
	});
	


$('.card_buttons').on('click', '.add_invoice', function(){
    "use strict";
  		var url= baseUrl+"sales/new_invoice";
        getAjaxView(url,data=null,'ajaxview',false,'get');
    });
    
$('.nav-item').on('click','#payment-tab', function(){
    "use strict";
        var paymenturl = baseUrl+"sales/invoice/payment/"+$("#invoice").attr("data-id");
        getAjaxView(paymenturl,data=null,'payment',false,'get');
            }); 
            
 $('.nav-item').on('click','#task-tab', function(){
     "use strict";
        var taskurl = baseUrl+"sales/invoice/task/"+$("#invoice").attr("data-id");
        getAjaxView(taskurl,data=null,'task',false,'get');
    }); 
      
$('.nav-item').on('click','#note-tab', function(){
          "use strict";
        var noteurl = baseUrl+"sales/invoice/note/"+$("#invoice").attr("data-id");
        getAjaxView(noteurl,data=null,'note',false,'get');
});

$('.nav-item').on('click','#reminder-tab', function(){
          "use strict";
        var noteurl = baseUrl+"sales/invoice/reminder/"+$("#invoice").attr("data-id");
        getAjaxView(noteurl,data=null,'reminder',false,'get');
});
            
$('.nav-item').on('click','#active-tab', function(){
     "use strict";     
        var noteurl = baseUrl+"sales/invoice/active/"+$("#invoice").attr("data-id");
        getAjaxView(noteurl,data=null,'active',false,'get');
 });
  
  
   $('#myTable').on('click', '.edit-tr', function(){
    "use strict";
        var id  = this.id.replace('edit-tr-', '');
        
        var url= baseUrl+"sales/invoice/edit/"+id;
      getAjaxView(url,data=null,'ajaxview',false,'get');
    });
 $('#myTable').on('click', '.view-tr', function(){
    "use strict";
        var id  = this.id.replace('view-tr-', '');
        var invoiceurl = baseUrl+"sales/invoice/showinvoice/"+id;
        $("#invoice").attr('data-id',id);
        $('.nav-link').removeClass('active');
        $('#invoice-tab-data').addClass('active');
        $('.tab-pane').removeClass('active');
        $('#invoice').addClass('active');
        getAjaxView(invoiceurl,data=null,'invoice',false,'get');

    });

 $('#myTable').on('click', '.delete-tr', function(){
    "use strict";
        var id  = this.id.replace('delete-tr-', '');
        var currentRow=$(this).closest("tr");
        var name= currentRow.find("td:eq(1)").text();
        /*edit after js lang check*/
        var content = i18n.msg.are_you_delete_it+name+'?';
        var confirmtext = i18n.msg.delete_success;
        var confirmCallback=function(){
        var requestCallback=function(response){
            if(response.status == 'success') {
                /*edit after js lang check*/
                toastr.success(' ',i18n.layout.success,{ closeButton: true });
               
                currentRow.remove(); 
                }else{
                    /*edit after js lang check*/
                toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                }
            }

            var url= baseUrl+"sales/invoice/delete/"+id;
        
            ajaxGetRequest(url,requestCallback);

        }
        confirmAlert(confirmCallback,content,confirmtext)
    });



   