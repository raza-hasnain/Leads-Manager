$('.add_item').on('click', '#submit_additem', function(){
    "use strict";
        var form=$('#item-add-form');
        var successcallback=function(a){
             toastr.success(i18n.menu.Items+" "+i18n.msg.create_successfully, i18n.layout.success,{ closeButton: true });
            $('#ajax-modal').modal('hide');
            location.reload();
        }
        ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
    });
