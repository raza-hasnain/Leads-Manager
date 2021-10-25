$(document).ready(function() {
    "use strict";

	$('.comment').each(function() {
   var id = $(this).attr("id");
    $(this).removeClass('comment')
      let url = baseUrl+"/facebookpost/comments/"+id;
   
 
   var successCallback=function(a){
            var i=0;
               if(a.status !== undefined){
              $('#comments-'+id).text(a.status.length);
            }

             $.each(a.status,function(i,n){
             if(typeof n['from']=== 'undefined'){
               $('#'+id).append($('<div class="inbox-item"><div class="inbox-item-img"><img class="rounded-circle" src="'+baseUrl+'public/admin_layout/img/avatar.png" alt=""></div><strong class="inbox-item-author mr-1" id="name-'+n['id']+'">No name </strong><span class="comments">'+n['message']+'</span><p class="inbox-item-text"><span class="mr-3 text-base cp">'+i18n.facebookpost.like+'</span><span id="'+n['id']+'"onclick="replycomment(this)"  data-message = "'+id+'" class="write_reply cp text-base mr-3" >'+i18n.facebookpost.reply+'</span><span class="write_message cp text-base" onclick="replyprivate(this)" data-message = "'+id+'" id="message-'+n['id']+'" >'+i18n.facebookpost.message+'</span> <span class="write_message cp text-base" onclick = "showrelycomment(this)" id="replycomment-'+n['id']+'" data-message = "'+id+'" >'+i18n.facebookpost.view+' '+i18n.facebookpost.reply+' </span> <span class="text-base"></span></p></div><div class="reply_item ml-5"  id="reply_item-'+n['id']+'"></div>'));
             }
             else{
              $('#'+id).append($('<div class="inbox-item"><div class="inbox-item-img"><img class="rounded-circle" src="'+baseUrl+'public/admin_layout/img/avatar.png" alt=""></div><strong class="inbox-item-author mr-1" id="name-'+n['id']+'">'+n['from']['name']+'</strong><span class="comments">'+n['message']+'</span><p class="inbox-item-text"><span class="mr-3 text-base cp">'+i18n.facebookpost.like+'</span><span class="write_reply cp text-base mr-3" id="'+n['id']+'" onclick="replycomment(this)" data-message = "'+id+'" >'+i18n.facebookpost.reply+'</span><span class="write_message cp text-base" onclick="replyprivate(this)" data-message = "'+id+'" id="message-'+n['id']+'" >'+i18n.facebookpost.message+'</span> <span class="write_message cp text-base" onclick = "showrelycomment(this)" id="replycomment-'+n['id']+'" data-message = "'+id+'" >'+i18n.facebookpost.view+' '+i18n.facebookpost.reply+' </span><span class="text-base"></span></p></div><div class="reply_item ml-5"  id="reply_item-'+n['id']+'"></div>'));

             }
             /*on click event */
             
          })
             
        }
    getAjaxdata(url,successCallback);   
  
     
      });

});