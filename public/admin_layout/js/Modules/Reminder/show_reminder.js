$(document).ready(function(){

"use strict";
$('.card_buttons').on('click','.add_task', function(){
            var url = $(this).attr('data-url');
            var  id = $(this).attr('data-id');
            var paymenturl = baseUrl+url+"/reminder/add/"+$("#"+id).attr("data-id");
            getAjaxModal(paymenturl);
           
          });
	
});

$('#reminderTable').on('click', '.edit-reminder-tr', function(){
    "use strict";
        var id  = this.id.replace('edit-tr-', '');
        
        var url= baseUrl+"reminder/edit/"+id;
        getAjaxModal(url);
    });
 $('#reminderTable').on('click', '.view-reminder-tr', function(){
    "use strict";
        var id  = this.id.replace('view-tr-', '');
        
        var url= baseUrl+"reminder/view/"+id;
        getAjaxModal(url);
    });

 $('#reminderTable').on('click', '.delete-reminder-tr', function(){
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

            var url= baseUrl+"reminder/delete/"+id;
        
            ajaxGetRequest(url,requestCallback);

        }
        confirmAlert(confirmCallback,content,confirmtext)
    });