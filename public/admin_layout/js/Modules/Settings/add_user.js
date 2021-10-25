  $('document').ready(function(){
                "use strict";
           $('.Submit').on('click', '#Submit_pusher_setting', function(){
               var form=$('#add-form');
            var successcallback=function(a){
              toastr.success(a.msg, 'success!',{ closeButton: true });
            $(form).trigger("reset");
              
        }
        ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
            });

      
             });