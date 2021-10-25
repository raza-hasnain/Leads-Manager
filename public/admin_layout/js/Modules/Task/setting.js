
$('document').ready(function(){
    "use strict";
    $('.table').on('click', '.edit-tr-status', function(){
        var leadID  = this.id.replace('edit-tr-status-', '');
	    var url= baseUrl+"task/task_statusedit/"+leadID;
        getAjaxModal(url);
  	
    });
    
      $('.table').on('click', '.delete-tr-status', function(){
        var leadID  = this.id.replace('delete-tr-status-', '');
        var currentRow=$(this).closest("tr");
    	var value= currentRow.find("td:eq(0)").text();
    	var name = $.trim(value);
    	var content = i18n.layout.delete+" "+name+'?';
        var confirmtext = i18n.msg.are_you_delete_it+'?';
        var confirmCallback=function(){
        var requestCallback=function(response){
            if(response.status == 'success') {
                
                 toastr.success(' ', i18n.layout.success,{ closeButton: true });
               
    		     currentRow.remove();  
                }else{
                /*Lang Change*/
              toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                }
            }
            var url= baseUrl+"task/task_deletestatus/"+leadID;
            ajaxGetRequest(url,requestCallback);
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });

    
    $('.table').on('click', '.edit-tr-source', function(){
        var leadID  = this.id.replace('edit-tr-source-', '');
        var url= baseUrl+"task/prioritie_edit/"+leadID;
        getAjaxModal(url);
  	
    });

    
    $('.table').on('click', '.delete-tr-source', function(){
        var leadID  = this.id.replace('delete-tr-source-', '');
        var currentRow=$(this).closest("tr");
    	var value= currentRow.find("td:eq(0)").text();
    	var name = $.trim(value);
    	var content = i18n.layout.delete+" "+name+'?';
        var confirmtext = i18n.msg.are_you_delete_it+'?';
        var confirmCallback=function(){
        var requestCallback=function(response){
            if(response.status == 'success') {
                
                 toastr.success(i18n.msg.delete_success, i18n.layout.success,{ closeButton: true });
               
    		     currentRow.remove();  
                }else{
                
              toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                }
            }
            var url= baseUrl+"task/prioritie_delete/"+leadID;
            ajaxGetRequest(url,requestCallback);
           
        }
        confirmAlert(confirmCallback,content,confirmtext);
    });
    
    $('.table').on('click', '.edit-tr-invoicestatus', function(){
        var leadID  = this.id.replace('edit-tr-invoicestatus-', '');
        var url= baseUrl+"task/resolution_edit/"+leadID;
        getAjaxModal(url);
  	
    });

    
    $('.table').on('click', '.delete-tr-invoicestatus', function(){
        var leadID  = this.id.replace('delete-tr-invoicestatus-', '');
        var currentRow=$(this).closest("tr");
    	var value= currentRow.find("td:eq(0)").text();
    	var name = $.trim(value);
    	var content = i18n.layout.delete+" "+name+'?';
        var confirmtext = i18n.msg.are_you_delete_it+'?';
        var confirmCallback=function(){
        var requestCallback=function(response){
            if(response.status == 'success') {
                
                 toastr.success(i18n.msg.delete_success, i18n.layout.success,{ closeButton: true });
               
    		     currentRow.remove();  
                }else{
                
              toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                }
            }
            var url= baseUrl+"task/resolution_delete/"+leadID;
            ajaxGetRequest(url,requestCallback);
           
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });
    
    $('.table').on('click', '.edit-tr-paymentsource', function(){
        var leadID  = this.id.replace('edit-tr-paymentsource-', '');
        var url= baseUrl+"task/medium_edit/"+leadID;
        getAjaxModal(url);
  	
    });

    
    $('.table').on('click', '.delete-tr-paymentsource', function(){
        var leadID  = this.id.replace('delete-tr-paymentsource-', '');
        var currentRow=$(this).closest("tr");
    	var value= currentRow.find("td:eq(0)").text();
    	var name = $.trim(value);
    	var content = i18n.layout.delete+" "+name+'?';
        var confirmtext = i18n.msg.are_you_delete_it+'?';
        var confirmCallback=function(){
        var requestCallback=function(response){
            if(response.status == 'success') {
                
                 toastr.success(i18n.msg.delete_success, i18n.layout.success,{ closeButton: true });
               
    		     currentRow.remove();  
                }else{
                
              toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                }
            }
            var url= baseUrl+"task/medium_delete/"+leadID;
            ajaxGetRequest(url,requestCallback);
           
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });
    
    $('.status').on('click', '.add_status', function(){
        var url= baseUrl+"task/task_statusedit";
    
        getAjaxModal(url);
    
    });
    
     $('.source').on('click', '.add_source', function(){
             var url= baseUrl+"task/prioritie_edit";
    
        getAjaxModal(url);
    
    });
        $('.source').on('click', '.add_invoice_status', function(){
             var url= baseUrl+"task/resolution_edit";
    
        getAjaxModal(url);
    
    });
    $('.source').on('click', '.add_payment_source', function(){
             var url= baseUrl+"task/medium_edit";
    
        getAjaxModal(url);
    
    });

});

 