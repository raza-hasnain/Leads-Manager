    $(document).ready(function() {
        "use strict";
        $(".select2").select2({
            placeholder: " @lang('layout.select')",
            minimumInputLength: 2,
        });

    });
    $('#submitEditLead').on('click', function(){
        "use strict";
        var form = $('#lead-edit-form');
        var successcallback = function(a){
            /*Lang Change*/
           toastr.success(i18n.menu.Leads+" "+i18n.msg.update_successfully, i18n.layout.success,{ closeButton: true });
            $('#ajax-modal').modal('hide');
            var id = $('#form_submited').val();
            var leadID = $('#form_submited').attr('class').replace('lead-id-', '');
            if (id == 1) {
                table.ajax.reload( null, false );
            }else{
                var url= baseUrl+"leads/view/"+leadID;
                getAjaxView(url,data=null,'ajaxview',false,'get');
            }
    }
        ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
    });