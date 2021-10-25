
    $('#contact_check').on('click', function(){
         "use strict";
        if($('#contact_check').prop('checked')) {
            $('#date_time').removeClass('d-none'); 
            $('#date_time').addClass('d-block');
            
   
        } else {
            $('#date_time').removeClass('d-block');
            $('#date_time').addClass('d-none');
           
        }
    });
    $('#submitEditLead').on('click', function(){
         "use strict";
        var form = $('#lead-update-form');
        var leadform  = form.attr('action');
        var data = leadform.split("/");
        var id = data[data.length-1];
        
        var successcallback = function(a){
             toastr.success(i18n.menu.Leads+" "+i18n.msg.update_successfully, i18n.layout.success,{ closeButton: true });
            $('#ajax-modal').modal('hide');
            var url= baseUrl+"leads/view/"+id;
        
            getAjaxView(url,data=null,'ajaxview',false,'get');
        }
        ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
    });
    $('.datetimepick').datetimepicker({ footer: true, modal: true,format: 'yyyy-mm-dd HH:MM',uiLibrary: 'bootstrap' });