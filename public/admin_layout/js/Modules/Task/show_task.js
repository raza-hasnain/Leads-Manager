$(document).ready(function(){

"use strict";
$('.card_buttons').on('click','.add_task', function(){
             var url = $(this).attr('data-url');
             var id = $(this).attr('data-id');
            var paymenturl = baseUrl+url+"/task/add/"+$("#"+id).attr("data-id");
       
            getAjaxModal(paymenturl);
           
          });
	$('.customer_submit').on('click', '#add_note', function(){
        var form=$('#note-add-form');
        var successcallback=function(a){
           $( "#note-tab" ).trigger( "click" );
            toastr.success(a.msg, i18n.layout.success,{ closeButton: true });
           
            
        }
     
        ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
    });
   
});
 $('#tasktable').on('click', '.edit-task-tr', function(){
    "use strict";
        var id  = this.id.replace('edit-tr-', '');
        
        var url= baseUrl+"task/edit/"+id;
        getAjaxModal(url);
    });
 $('#tasktable').on('click', '.view-task-tr', function(){
    "use strict";
        var id  = this.id.replace('view-tr-', '');
        
        var url= baseUrl+"task/view/"+id;
        getAjaxModal(url);
    });

 $('#tasktable').on('click', '.delete-task-tr', function(){
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

            var url= baseUrl+"task/delete/"+id;
        
            ajaxGetRequest(url,requestCallback);

        }
        confirmAlert(confirmCallback,content,confirmtext)
    });
  $('#note').on('click', '.edit-tr', function(){
    "use strict";
        var id  = this.id.replace('edit-tr-', '');
        
        var url= baseUrl+"note/edit/"+id;
        getAjaxModal(url);
    });
  $('#note').on('click', '.delete-tr', function(){
    "use strict";
        var id  = this.id.replace('delete-tr-', '');
        var currentRow=$(this).closest("li");
        
        /*edit after js lang check*/
        var content = i18n.msg.are_you_delete_it+'?';
        var confirmtext = i18n.msg.delete_success;
        var confirmCallback=function(){
        var requestCallback=function(response){
            if(response.status == 'success') {
                /*edit after js lang check*/
                toastr.success(i18n.layout.success,{ closeButton: true });
               
                currentRow.remove(); 
                }else{
                    /*edit after js lang check*/
                toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                }
            }

            var url= baseUrl+"note/delete/"+id;
        
            ajaxGetRequest(url,requestCallback);

        }
        confirmAlert(confirmCallback,content,confirmtext)
    });