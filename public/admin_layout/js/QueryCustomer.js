$(document).ready(function() {
    "use strict";
	$('#ajax-modal').modal('show');
});
    $('.customer_querysubmit').on('click', '#add_customer', function(){
        "use strict";
        var form=$('#customer-queryadd-form');
        var successcallback=function(a){
            toastr.success(i18n.customers.customer+" "+i18n.msg.create_successfully, i18n.layout.success,{ closeButton: true });
            $('#ajax-modal').modal('hide');
            location.href=baseUrl+"/home"; 
        }
        ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
    });
    $('.lead_querysubmit').on('click', '#add_lead', function(){
        "use strict";
        var form=$('#lead-queryadd-form');
        var successcallback=function(a){
            toastr.success(i18n.leads.lead+" "+i18n.msg.create_successfully, i18n.layout.success,{ closeButton: true });
            $('#ajax-modal').modal('hide');
            location.href=baseUrl+"/home"; 
        }
        ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
    });