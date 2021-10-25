
$(document).ready(function(){
    "use strict";
    $('.customer_submit').on('click','#add_payment',function(){
    	var form=$('#payment-add-form');
    	      
            var successcallback=function(a){
                toastr.success(a.msg, 'success!',{ closeButton: true });
                $( "#payment-tab" ).trigger( "click" );
                $('#ajax-modal').modal('hide');
            }
            ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
    });
    $('.form-group').on('change','#paymenttype',function(){
    		 var selectedItem = $(this).val();
      			var type = $('option:selected',this).data("value");
      			if(type==1){
      				$('#type-one').removeClass('d-none');
      				
      				$('#type-none').addClass('d-none');
      				
      				$('#bank-name').attr('name', 'title' ); 
      				$('#bank-number').attr('name', 'title_number'); 
      				$('#bank-code').attr('name', 'swift_no'); 
      				$('#person-name').removeAttr('name');
      				$('#person-number').removeAttr('name');
      			}
      			else{
      				$('#type-none').removeClass('d-none');
      				
      				$('#type-one').addClass('d-none');
      				$('#person-name').attr('name','title');
      				$('#person-number').attr('name','title_number');
      				$('#bank-name').removeAttr('name' ); 
      				$('#bank-number').removeAttr('name'); 
      				$('#bank-code').removeAttr('name'); 
      				
      			}
    	});

});