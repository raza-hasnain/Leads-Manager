
    
$(document).ready(function() {
    "use strict";
    
    $('.date_value').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'YYYY-MM-DD'
        },
             
    });
        data = window.location.pathname.split("/");
        var id =  data[data.length-1];
        var page = data[data.length-2];
       
        if(isNaN(id)){
        loadPost();
        }
        else{
           loadPost(count = 1,id,page);
        }
  
         var count = 2;
         var total = 20;
        
       $(window).scroll(20,function(){
          var height  = $(document).height() - $(window).height()-20;
            
           if ($(this).scrollTop() > height) { 
               if (count > total){
                            return false;
                       }else{
                            loaddata(count);
                       }
                       count++;
       
              } 
        
       });

    //call load report
    loadReport();
    $(document).on('change','#end_date', function(){
    
        var  end_date =  $('#end_date').val();
        var start_date = $('#start_date').val();
    
        let url = baseUrl+"/facebookpost/fbReport/"+start_date+"/"+end_date;
           getAjaxView(url,data=null,'facebookReport',false,'get');

   });
      
});
     
     $(document).on('click','.post-delete', function(){
         "use strict";
            var postid  = this.id.replace('delete-', '');
    	    var content = i18n.msg.are_you_delete_it+'?';
    	    var confirmtext = i18n.msg.delete_success;
            var confirmCallback=function(){
                var requestCallback=function(response){
                    if(response.status == 'success') {
                        
                        toastr.success( i18n.layout.success,{ closeButton: true });
                       $('#colum-'+postid).remove();  
                        }else{
                            
                        toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                        }
                }
                var url= baseUrl+"facebookpost/delete/"+postid;
                ajaxGetRequest(url,requestCallback);

            }
        confirmAlert(confirmCallback,content,confirmtext)
    });


  function loaddata(count){
      
         data = window.location.pathname.split("/");
         var id =  data[data.length-1];
           var page = data[data.length-2];
        if(isNaN(id) ){
        loadPost(count);
        }
        else{
           loadPost(count,id,page);
          
        }
  }

    function replycomment(data)
    {
    
      var replyID = $(data).attr("id");
      var count = $("#send-"+replyID).length;
      var datamessage = $(data).attr('data-message');
      
     if( count == 0)
      {
      $("#reply_item-"+replyID).append($('<div class="inbox-item"> <div class="input-group"><div class="inbox-item-img"><img class="rounded-circle" src="'+baseUrl+'public/admin_layout/img/avatar.png" alt=""></div><input id="input-'+replyID+'" class="form-control input-sm mt-1" placeholder="Write a reply"><div class="btn-group btn-group-sm mt-1 mb-2" role="group" aria-label="Small button group"><button id="send-'+replyID+'" onclick="sendcomment(this)" data-message = "'+datamessage+'" class="btn btn-base ml-1">Send</button></div></div></div>'));
        }
  }

  function replyprivate(data)
  {
     
        var replyID = $(data).attr("id");
        var id = replyID.replace('message-', '');
        var name = $('#name-'+id).text();
        
        var postid = $(data).attr('data-message');
          let url = baseUrl+"/facebookpost/showMessage/"+id+"/"+name+"/"+postid;
      
        getAjaxView(url,data=null,'chatbox',false,'get');

  }
function loadPost(num = 1, id= null, page = null){
       
        if(page == null){
    
          let url = baseUrl+"/facebookpost/fb_post?page="+num;
           getAjaxView(url,data=null,'facebookpost-'+num,false,'get');
        }
       else{
            let url = baseUrl+"/facebookpost/fb_post/"+page+"/"+id+"?page="+num;
            getAjaxView(url,data=null,'facebookpost-'+num,false,'get');
            }
    }



    function showrelycomment(data)
    {
        
          var replyID = $(data).attr("id");
          var id = replyID.replace('replycomment-', '');
        
          var datamessage = $(data).attr('data-message');
          let url = baseUrl+"/facebookpost/showreplycomments/"+id+"/"+datamessage;
         
              var successCallback=function(a)
                    {
        
                       $('#reply_item-'+id).empty();
                       $.each(a.commends,function(i,n){
                        if(typeof n['from']=== 'undefined'){
                        $('#reply_item-'+id).append($('<div class="inbox-item"><div class="inbox-item-img"><img class="rounded-circle" src="'+baseUrl+'public/admin_layout/img/avatar2.png" alt=""></div><strong class="inbox-item-author mr-1">No name</strong><span class="comments">'+n['message']+'</span><p class="inbox-item-text"><span class="mr-3 text-base cp">Like</span><span class="write_reply cp text-base mr-3"  id="'+n['id']+'" onclick="replycomment(this)" data-message = "'+datamessage+'">'+i18n.facebookpost.reply+'</span><span class="write_message cp text-base" onclick="replyprivate(this)" data-message = "'+datamessage+'" id="message-'+n['id']+'" >'+i18n.facebookpost.message+'</span> <span class="text-base">1m</span></p></div><div class="reply_item ml-5"  id="reply_item-'+n['id']+'"></div>'));
                        }
                        else{
                          $('#reply_item-'+id).append($('<div class="inbox-item"><div class="inbox-item-img"><img class="rounded-circle" src="'+baseUrl+'public/admin_layout/img/avatar2.png" alt=""></div><strong class="inbox-item-author mr-1" id="name-'+n['id']+'">'+n['from']['name']+'</strong><span class="comments">'+n['message']+'</span><p class="inbox-item-text"><span class="mr-3 text-base cp">Like</span><span class="write_reply cp text-base mr-3" id="'+n['id']+'" onclick="replycomment(this)" data-message = "'+datamessage+'" >'+i18n.facebookpost.reply+'</span><span class="write_message cp text-base" onclick="replyprivate(this)" data-message = "'+datamessage+'" id="message-'+n['id']+'" >'+i18n.facebookpost.message+'</span> <span class="text-base">1m</span></p></div><div class="reply_item ml-5"  id="reply_item-'+n['id']+'"></div>'));
                        }
                    });
                   
                 }
              getAjaxdata(url,successCallback); 
        }


   function readURL(input) {
       
        if (input.files && input.files[0]) {
            var reader = new FileReader(); 
            reader.onload = function(e) {
            $('#uploaded').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            }
    }

    function sendcomment(data){
       
          var replyID = $(data).attr("id");
          var id = replyID.replace('send-', '');
          var commands = $('#input-'+id).val();
          var pageid = $(data).attr("data-message");
          var data={"_token": XCSRFTOKEN, id:id, commands:commands,pageid:pageid };
          var successcallback=function(a){
              if(a.status == 'success'){
               
              toastr.success(i18n.layout.success, i18n.msg.update_successfully,{ closeButton: true });
                  $("#reply_item-"+id).empty();
               
              }
              else{
                toastr.error(i18n.layout.error, a.status,{ closeButton: true });
                $("#reply_item-"+id).empty();
              }
        }
        let url = baseUrl+"/facebookpost/commentspost";
       
           ajaxFormSubmit(url,data,submitId='',successcallback);
    }

    function sendMessage(data){
        
      var replyID = $(data).attr("id");
      var id = replyID.replace('messageSend-', '');
      var commands = $('#input-'+id).val();
      var pageid = $(data).attr("data-message");
      var data={"_token": XCSRFTOKEN, id:id, commands:commands,pageid:pageid };
        var successcallback=function(a){
          if(a.status == 'success'){
            
          toastr.success("@lang('facebook.success')", "@lang('facebook.success_comments')",{ closeButton: true });
              $("#reply_item-"+id).empty();
          }
          else{
            toastr.error("@lang('facebook.error')", a.status,{ closeButton: true });
            $("#reply_item-"+id).empty();
          }
        }
        
        let url = baseUrl+"/facebookpost/privateCommentspost";
        
           ajaxFormSubmit(url,data,submitId='',successcallback);
    }

 function addimage(){
     
        readURL(this);
    }
function loadReport(){
    
      let url = baseUrl+"/facebookpost/fbReport";
       getAjaxView(url,data=null,'facebookReport',false,'get');
   }
  