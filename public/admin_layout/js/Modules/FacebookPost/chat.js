 $(document).ready(function () {
            "use strict";
                setTimeout(function () {
                    $(".bd-chat").slideDown("slow");
                }, 3000);
                $(".chat-toggle").on("click", function () {
                    $(".bd-chat").slideToggle(300, "swing");
                    $(this).toggleClass('open');
                });
                $(".chat-close").on("click", function (e) {
                    e.preventDefault();
                    $(".bd-live-chat").hide();
                });
              
            var findid = $(document).find("#customer-message");
   
             if(findid.length > 0) {
                 $('.chat-settings').remove();
                }
                
});
    $('.send_data').on('click', '.send', function(){
        "use strict";
        var id = $(this).attr("id");
        var commands = $('#input-'+id).val();
        commands = commands.replace(/script/g, "remove");
        var pageid = $(this).attr("data-id");
        var data={"_token": XCSRFTOKEN, id:id, commands:commands,pageid:pageid };
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
         var successcallback=function(a){
          if(a.status == 'success'){
            
          toastr.success(i18n.layout.success, commands,{ closeButton: true });
              $('#input-'+id).val("");
           $('#me').append('<div class="message me"><div class="text-main"><span class="time-ago"><i class="fa fa-clock-o" aria-hidden="true"></i>'+h+':'+m+':'+s+'</span><div class="text-group me"><div class="text me"><p> '+commands+'</p></div></div></div></div>');
           jQuery('.bd-message-content')[0].scrollTop =jQuery('.bd-message-content')[0].scrollHeight;
          }
          else{
            toastr.error(i18n.layout.error, a.status,{ closeButton: true });
        
          }
            }
      
        let url = baseUrl+"/facebookpost/privateCommentspost";
           
           ajaxFormSubmit(url,data,'',successcallback);
});

    $('.send_data').on('keyup', '.send-message-sb', function(e){
        "use strict";
        var id = $('.send').attr("id");
        var code = (e.keyCode ? e.keyCode : e.which);
        var commands = $('#input-'+id).val();
        
    if (code == 13 && commands != '') {
        commands = commands.replace(/script/g, "remove");
        var pageid = $('.send').attr("data-id");
        var data={"_token": XCSRFTOKEN, id:id, commands:commands,pageid:pageid };
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
         var successcallback=function(a){
          if(a.status == 'success'){
            
          toastr.success(i18n.layout.success, commands,{ closeButton: true });
              $('#input-'+id).val("");
           $('#me').append('<div class="message me"><div class="text-main"><span class="time-ago"><i class="fa fa-clock-o" aria-hidden="true"></i>'+h+':'+m+':'+s+'</span><div class="text-group me"><div class="text me"><p> '+commands+'</p></div></div></div></div>');
           jQuery('.bd-message-content')[0].scrollTop =jQuery('.bd-message-content')[0].scrollHeight;
          }
          else{
            toastr.error(i18n.layout.error, a.status,{ closeButton: true });
        
          }
            }
      
        let url = baseUrl+"/facebookpost/privateCommentspost";
           
           ajaxFormSubmit(url,data,'',successcallback);
    }
});

$('.convert').on('click','.convert-id',function(){
        "use strict";
        var rid = $(this).attr("id");
        var id = rid.replace('convert-', '');
        var name = $("#name-"+id).text();
        var successcallback=function(a){
              if(a.status == 'success'){
              toastr.success(i18n.layout.success, a.msg),{ closeButton: true };
                 }
              else{
                toastr.error(i18n.layout.error, a.status,{ closeButton: true });
              }
            
        }
          var data={"_token": XCSRFTOKEN, id:id,name:name,sourcs:'facebook' };
             let url = baseUrl+"/leads/convert";
         
           ajaxFormSubmit(url,data,'',successcallback);
});
  
    $( "div.demo" ).scrollTop( 300 );
