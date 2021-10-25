$('document').ready(function(){
     "use strict";
        $('.summary').on('click', '.add_summary', function(){
            var leadID  = this.id.replace('summary-', '');
            var url= baseUrl+"leads/add_summary/"+leadID;
            getAjaxModal(url);
        });
        $('.more').on('click', '.edit-tr', function(){
            var leadID  = this.id.replace('edit-tr-', '');
            var url= baseUrl+"leads/edit/"+leadID;
            getAjaxModal(url,2);
        });
        $('.more').on('click', '.convert_customer', function(){
            var leadID  = this.id.replace('convert-tr-', '');
            var url= baseUrl+"leads/convert_customer/"+leadID;
            getAjaxModal(url,2);
        });
        $('#get_estimates').on('click', '.estimates', function(){
            var leadID  = this.id.replace('get_estimate-', '');
            var module_id =2;
            var url= baseUrl+"leads/estimates/"+module_id+"/"+leadID;
            getAjaxView(url,data=null,'tabs1-2',false,'get');
        });
        $('#get_proposals').on('click', '.proposals', function(){
            var leadID  = this.id.replace('get_proposal-', '');
            var module_id =2;
            var url= baseUrl+"leads/proposals/"+module_id+"/"+leadID;
            getAjaxView(url,data=null,'tabs1-3',false,'get');
        });
        $('.contact').on('click','#fid',function(){
            var userid = $(this).attr("data-id");
            var name = $(this).attr("data-name");
            var url= baseUrl+"/facebookpost/showMessagelead/"+userid+"/"+name;
             getAjaxView(url,data=null,'chatbox',false,'get');
        });
         $('.contact').on('click','#email',function(){
            var userid = $(this).attr("data-id");
            var name = $(this).attr("data-name");
            var url= baseUrl+"leads/email_send/"+userid;
            getAjaxModal(url);
             
        });

        $('[data-toggle="tooltip"]').tooltip();
        $('.nav-item').on('click','#task-tab', function(){
          
        var taskurl = baseUrl+"leads/task/"+$("#leads").attr("data-id");
   
        getAjaxView(taskurl,data=null,'task',false,'get');
            }); 
      
          $('.nav-item').on('click','#note-tab', function(){
          
        var noteurl = baseUrl+"leads/note/"+$("#leads").attr("data-id");
        getAjaxView(noteurl,data=null,'note',false,'get');
            });
      $('.nav-item').on('click','#reminder-tab', function(){
          
        var noteurl = baseUrl+"leads/reminder/"+$("#leads").attr("data-id");
        getAjaxView(noteurl,data=null,'reminder',false,'get');
            });
      $('.nav-item').on('click','#active-tab', function(){
          
        var noteurl = baseUrl+"leads/active/"+$("#leads").attr("data-id");
        getAjaxView(noteurl,data=null,'active',false,'get');
            });
      $('.more').on('click', '.log_touch', function(){
            var url= baseUrl+"leads/log_active/"+$("#leads").attr("data-id");
            getAjaxModal(url);
        });
});