$(document).ready(function() {
    "use strict";
    $('.more').on('click', '.update-tr', function(){
        
        var customerID  = this.id.replace('update-tr-', '');
        var url= baseUrl+"customer/status_update/"+customerID;
        var name = $(".cus_name").text();
      
        var content = i18n.msg.update_status_of+' '+name+'?';
        var confirmtext = i18n.msg.update_status; 
        var confirmCallback=function(){
        var successcallback = function(a){
            if (a.status == 'success') {
              
                toastr.success(i18n.customers.customer+" "+i18n.msg.update_successfully,  i18n.layout.success,{ closeButton: true });
                var url= baseUrl+"customer/view/"+customerID;
                getAjaxView(url,data=null,'ajaxview',false,'get');   
            }else{
                /*edit after js lang check*/
                toastr.error(i18n.msg.update_error, i18n.layout.error,{ closeButton: true });
                }  
            }
            ajaxGetRequest(url,successcallback);
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });
    $('.more').on('click', '.edit-tr', function(){
       
                
                var userID  = this.id.replace('edit-tr-', '');
                   var url= baseUrl+"customer/edit/"+userID;
                getAjaxModal(url,2);
    });
    
    $('.view_estimate').on('click', '.view-tr', function(){
     
            var estimateID  = this.id.replace('view-tr-', '');
            var url= baseUrl+"sales/view_estimate/"+estimateID;
            getAjaxView(url,data=null,'ajaxview',false,'get');
    });
    
    $('.contact').on('click','#fid',function(){
      
        var userid = $(this).attr("data-id");
        var name = $(this).attr("data-name");
        var url= baseUrl+"facebookpost/showMessagelead/"+userid+"/"+name;
        getAjaxView(url,data=null,'chatbox',false,'get');
    });
            
    $('.contact').on('click','#email',function(){
       
            var userid = $(this).attr("data-id");
            var name = $(this).attr("data-name");
            var url= baseUrl+"customer/email_send/"+userid;
            getAjaxModal(url)
             
    });
    $('[data-toggle="tooltip"]').tooltip();
            
    $('.view_estimate').on('click', '.copy-link', function(){
        
        var estimateID  = this.id.replace('copy-tr-', '');
        copyToClipboard($('#link-tr-'+estimateID).attr('href'));
    });
    
    $('.nav-item').on('click','#task-tab', function()
    {
        
        var taskurl = baseUrl+"customer/task/"+$("#customer").attr("data-id");
        getAjaxView(taskurl,data=null,'task',false,'get');
    }); 
          
    $('.nav-item').on('click','#note-tab', function(){
       
             var noteurl = baseUrl+"customer/note/"+$("#customer").attr("data-id");
            getAjaxView(noteurl,data=null,'note',false,'get');
    });
    
    $('.nav-item').on('click','#reminder-tab', function(){
             
        var noteurl = baseUrl+"customer/reminder/"+$("#customer").attr("data-id");
        getAjaxView(noteurl,data=null,'reminder',false,'get');
    });
    
    $('.nav-item').on('click','#active-tab', function(){
        
            var noteurl = baseUrl+"customer/active/"+$("#customer").attr("data-id");
            getAjaxView(noteurl,data=null,'active',false,'get');
    });
});


        
