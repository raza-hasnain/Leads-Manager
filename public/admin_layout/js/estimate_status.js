  $('.estimate_submit').on('click', '.accept', function(){
      "use strict";
        var url = $(this).attr("data-url");
        var requestCallback=function(response){
            if(response.status == 'success') {
               toastr.success(i18n.layout.statuse+" "+i18n.msg.update_successfully, i18n.layout.success,{ closeButton: true });
              $('#estimate_body').remove();
              $('#estimate_con').removeClass('d-none');
                }else{
                toastr.error('Failed! Try Again', 'error!',{ closeButton: true });
                }
            }
        ajaxGetRequest(url,requestCallback);
        
    });
  $('.estimate_submit').on('click', '.deny', function(){
      "use strict";
        var url = $(this).attr("data-url");
        var requestCallback=function(response){
            if(response.status == 'success') {
               toastr.success(i18n.layout.statuse+" "+i18n.msg.update_successfully, i18n.layout.success,{ closeButton: true });
              $('#estimate_body').remove();
              $('#estimate_con').removeClass('d-none');
                }else{
                toastr.error('Failed! Try Again', 'error!',{ closeButton: true });
                }
            }
        ajaxGetRequest(url,requestCallback);
        
    });
