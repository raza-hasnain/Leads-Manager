
$('document').ready(function(){
    "use strict";
    $('.table').on('click', '.edit-tr', function(){
        var leadID  = this.id.replace('edit-tr-', '');
	    var url= baseUrl+"leads/statusedit/"+leadID;
        getAjaxModal(url);
  	
    });
    
      $('.table').on('click', '.delete-tr', function(){
        var leadID  = this.id.replace('delete-tr-', '');
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
                /*Lang Change*/
              toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                }
            }
            var url= baseUrl+"leads/deletestatus/"+leadID;
            ajaxGetRequest(url,requestCallback);
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });

    
    $('.sourcetable').on('click', '.edit-tr-source', function(){
        var leadID  = this.id.replace('edit-tr-source-', '');
        var url= baseUrl+"leads/sourceedit/"+leadID;
        getAjaxModal(url);
  	
    });

    
    $('.sourcetable').on('click', '.delete-tr-source', function(){
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
            var url= baseUrl+"leads/deletesource/"+leadID;
            ajaxGetRequest(url,requestCallback);
           
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });
    
    $('.status').on('click', '.add_status', function(){
        var url= baseUrl+"leads/statusedit";
    
        getAjaxModal(url);
    
    });
    
     $('.source').on('click', '.add_source', function(){
             var url= baseUrl+"leads/sourceedit";
    
        getAjaxModal(url);
    
    });

});

 