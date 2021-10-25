   Pusher.logToConsole = false;
   var channel = pusher.subscribe('chat');
        
    channel.bind('my-event', function(data) {
   
      $('#messages').append('<li><a  id="notic-id" data-id="'+data.user+'"><div class="icon"></div><div class="text"><h5 >'+data.user+'  <span>'+data.time+'</span></h5><span>'+data.message+'</span></div><span class="active-status text-danger float-right mt-4"><i class="fas fa-circle"></i></span></a></li>');
      $val = parseInt($('#count_messages').text());
      $('.count_messages').text($val+1);
      var findid = $(document).find("#"+data.user);
     
        if(findid.length > 0) {
          
          $('#me').append('<div class="message"><div class="text-main"><span class="time-ago">'+data.time+'</span><div class="text-group"><div class="text"><p> '+data.message+'</p></div></div></div></div>');
         jQuery('.bd-message-content')[0].scrollTop =jQuery('.bd-message-content')[0].scrollHeight;
            
        }
      
             
    });
    
       $('#messages').on('click','#notic-id',function(e){
            e.preventDefault();
            
        var userid = $(this).attr("data-id");
        var name = 'no name';
        var url= baseUrl+"/facebookpost/showMessagelead/"+userid+"/"+name;
        getAjaxView(url,data=null,'chatbox',false,'get');
    });