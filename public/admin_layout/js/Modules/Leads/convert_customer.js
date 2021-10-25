    $(document).ready(function() {
        "use strict";
        $(".select2").select2({
                placeholder: i18n.layout.select,
            minimumInputLength: 2,
        });

    });

    $('.customer_submit').on('click', '#add_customer', function(){
        "use strict";
        var form=$('#customer-add-form');
        var successcallback=function(a){
            /*Lang Change*/
             toastr.success(i18n.msg.convert_to+" "+i18n.menu.Customer+ i18n.layout.success,{ closeButton: true });
           
            $('#ajax-modal').modal('hide');
            location.reload();  
        }
        ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
    });
