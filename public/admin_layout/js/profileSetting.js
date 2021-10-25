   
    $('.profile_submit').on('click', '#add_profile', function()
    {
        "use strict";
        var form=$('#profile-add-form');
        var successcallback=function(a){
              toastr.success(' ', i18n.layout.success,{ closeButton: true });
           
            $('#ajax-modal').modal('hide');
              
        }
        ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
    });
  
    
     $('.settings-box').on('click', '.edit_profile', function()
     {
        "use strict";
        var url= baseUrl+"profileSetting";
        getAjaxModal(url);
    });
    
    $('.choice').on('click', '.radio', function(){
         "use strict";
         var value = $(this).val();
        
         $('.seen').each(function() {$(this).addClass('d-none')});
         $('#'+value).removeClass('d-none');
    });
    
    $('.seen').on('change','#estimate-id',function(){
       "use strict";
       var successcallback=function(a){
              toastr.success(a.msg,i18n.layout.success,{ closeButton: true });
              $('#input-type').attr('name', 'type');
              $('#input-type').val('estimate');
              $('#link-add').attr('name','link');
              $('#link-add').val(baseUrl+'estimate_link/'+a.code);
            $('#add_profile').prop('disabled', false);
        }
       var customer = $(document).find('#customer');
       
        var id = $(this).val();
        $('#add_profile').prop('disabled', true);
       
        var url = baseUrl+"customer/SendMail/"+id;
        
        getAjaxView(url,'','',successcallback);
    });
    
    $('.seen').on('change','#propsoals-id',function(){
       "use strict";
       var successcallback=function(a){
              toastr.success(a.msg,i18n.layout.success,{ closeButton: true });
              $('#input-type').attr('name', 'type');
              $('#input-type').val('propsoal');
              $('#link-add').attr('name','link');
              $('#link-add').val(baseUrl+'estimate_link/'+a.code);
            $('#add_profile').prop('disabled', false);
        }
       var customer = $(document).find('#customer');
       
        var id = $(this).val();
        $('#add_profile').prop('disabled', true);
       
        var url = baseUrl+"customer/SendMail/proposal/"+id;
        
        getAjaxView(url,'','',successcallback);
    });
    
     $('.seen').on('change','#invoice-id',function(){
       "use strict";
       var successcallback=function(a){
              toastr.success(a.msg,i18n.layout.success,{ closeButton: true });
              $('#input-type').attr('name', 'type');
              $('#input-type').val('invoice');
            $('#add_profile').prop('disabled', false);
        }
       var customer = $(document).find('#customer');
       
        var id = $(this).val();
        $('#add_profile').prop('disabled', true);
      
        var url = baseUrl+"sales/invoice/SendMail/"+id;
        
        getAjaxView(url,'','',successcallback);
    });