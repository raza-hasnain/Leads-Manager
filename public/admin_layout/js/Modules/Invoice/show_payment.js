
$(document).ready(function(){
    "use strict";
    $('.card_buttons').on('click','.add_payment', function(){
           
            var paymenturl = baseUrl+"sales/invoice/add_payment/"+$("#invoice").attr("data-id");
       
            getAjaxModal(paymenturl);
           
          });
});
 $('#paymentTable').on('click', '.view-payment-tr', function(){
    "use strict";
        var id  = this.id.replace('view-tr-', '');
        
        var url= baseUrl+"sales/invoice/view_payment/"+id;
        getAjaxModal(url);
    });

