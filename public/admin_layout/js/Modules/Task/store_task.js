$(document).ready(function(){

"use strict";
$('.customer_submit').on('click', '#add_customer', function(){
       
        var form= $(this).closest('form').attr('id');

        var successcallback=function(a){
           $( "#"+a.id ).trigger( "click" );
            var taskurl = baseUrl+"task/show_own";
           
            getAjaxView(taskurl,data=null,'task',false,'get');
            toastr.success(a.msg, i18n.layout.success,{ closeButton: true });
            $('#ajax-modal').modal('hide');
            
        }
       
        ajaxValidationFormSubmit($('#'+form).attr('action'),$('#'+form).serialize(),'',successcallback);
    });
    $('.datetimepick').datetimepicker({ footer: true, modal: true,format: 'yyyy-mm-dd HH:MM',uiLibrary: 'bootstrap' });
$('.enddate').datetimepicker({ footer: true, modal: true,format: 'yyyy-mm-dd HH:MM',uiLibrary: 'bootstrap' });
});