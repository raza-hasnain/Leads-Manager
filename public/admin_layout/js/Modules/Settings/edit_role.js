 $('document').ready(function(){
                "use strict";
           $('.table').on('click', '.edit-tr', function(){
        var rowid  = this.id.replace('edit-tr-', '');
        var url= baseUrl+"settings/role_edit/"+rowid;
           
        getAjaxView(url,data=null,'tab_setting',false,'get');
      
        
    });
    
    $('.table').on('click', '.delete-tr', function(){
        "use strict";
        var userID  = this.id.replace('delete-tr-', '');
        var currentRow=$(this).closest("tr");
    	var name= currentRow.find("td:eq(0)").text();
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

            var url= baseUrl+"settings/role_delete/"+userID;
		
            ajaxGetRequest(url,requestCallback);

        }
        confirmAlert(confirmCallback,content,confirmtext)
    });

             });