    $('.edit_category').on('click', '#submit_editcategory', function(){
        "use strict";
        var form=$('#itemcategory-edit-form');
        var successcallback=function(a){
             toastr.success(i18n.menu.Items+" "+i18n.msg.update_successfully, i18n.layout.success,{ closeButton: true });
            $('#ajax-modal').modal('hide');
           if(a.active_id !== undefined){
                var url_id = baseUrl+a.modules+"/setting";
        getAjaxView(url_id,data=null,'module-setting',false,'get');
               $('#module-setting').find('a').removeClass('active');
               $("a[href*='/#"+a.active_id+"/']").trigger( "click" );
              
            }
        }
        ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
    });