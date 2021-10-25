    $('document').ready(function(){
                "use strict";
           $('.Submit').on('click', '#Submit_pusher_setting', function(){
               var form=$('#add-form');
            var successcallback=function(a){
              toastr.success(a.msg, 'success!',{ closeButton: true });
            $( ".active" ).trigger( "click" );
              
        }
        ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
            });
                $('.check_input').on('change', function(){
                  var rowid  = this.id.replace('module-', '');
                  if (this.checked) {
                  $('.permission-'+rowid).removeAttr("disabled");
                }
                else{
                  $('.permission-'+rowid).attr("disabled", true);
                }
                });
             });

  