  var channel_new = pusher.subscribe('channel-new');
    
   channel_new.bind('new_event', function(data) {
        "use strict";
      $('#notices').append('<li><a href="#"><div class="icon"><img class="img img-fluid" src="'+baseUrl+'admin_layout/img/avatar.png" alt=""></div><div class="text"><h5 id="notic-id" data-id="'+data.user+'">'+data.user+'<span>'+data.time+'</span></h5><span>'+data.message+'</span></div><span class="active-status text-danger float-right mt-4"><i class="fas fa-circle"></i></span></a></li>');
      $val = parseInt($('#count_notices').text());
      $('.count_notices').text($val+1);
     
    });