
    $(document).ready(function() {
        "use strict";
        $(".select2").select2({
            placeholder: " @lang('layout.select')",
            minimumInputLength: 2,
        });

    });
    $('.lead_submit').on('click', '#add_lead', function(){
        "use strict";
        var form=$('#lead-add-form');
        var successcallback=function(a){
            toastr.success(i18n.menu.Leads+" "+i18n.msg.create_successfully, i18n.layout.success,{ closeButton: true });
            $('#ajax-modal').modal('hide');
            location.reload();  
        }
        ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
    });