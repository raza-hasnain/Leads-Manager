
    $( document ).ajaxError(function( response ) 
    {
        "use strict";
        if ( response.status ===500) {
    
            toastMessage(i18n.layout.error+'!','error',i18n.layout.please_contact_us_to_report_this_issue);
            location.reload();
    
        }
    });


    function getAjaxModal(url,dataid={},ajaxclass='#modal-ajaxview',callback=false,data={},modalclass='#ajax-modal',method='get')
    {
        
    $.ajax({
        url:url,
        type:method,
        data:data,
        beforeSend:function(xhr){
           
        },
        success:function(result){ 
           
            $(modalclass).modal('show');
            if(callback){
                callback(result);
                return;
            }
            $(ajaxclass).html(result); 
            $(".modal-body #form_submited").val(dataid);

        },error:function(a,b){

            toastr.error(a.responseJSON.status, i18n.layout.error+'!',{ closeButton: true });
                      
        }
        });
    }

    function getAjaxView(url,data={},ajaxclass,callback=false,method='get')
    {
       
        $.ajax({
            url:url,
            type:method,
            data:data,
            beforeSend:function(xhr){
                
            },
            success:function(result){
                if(callback){
                    callback(result);
                return;
                }
                $('#'+ajaxclass).html(result);
            },
            error:function(a){
                if(a.responseJSON.status == 'fail') {
            error= a.responseJSON.msg;
            toastr.error(i18n.layout.error+'!', error,{ closeButton: true });
        }
        else{
                toastr.error(a.responseJSON.status, i18n.layout.error+'!',{ closeButton: true });
        }
                           
            }
        });
        return false;
    }

    function getAjaxViewAppend(url,data={},ajaxclass,callback=false,method='get')
    {
      
        $.ajax({
        url:url,
        type:method,
        data:data,
        beforeSend:function(xhr){
            
        },
        success:function(result){
            if(callback){
                callback(result);
            return;
            }
            $('#'+ajaxclass).append(result);
        },
        error:function(a){
           toastr.error(a.responseJSON.status, i18n.layout.error+'!',{ closeButton: true });
                      
        }
        });
     return false;
    }

    function ajaxGetRequest(url,successCallback='',errorCallback='',datatypes='json')
    {
        
        $.ajax({
        url:url,
        type:'Get',     
        dataType:datatypes
        ,
        success:function(result){ 
            if(successCallback){
                successCallback(result);
                return;
            } 
            toastr.success("Updated Successfully!", "Success !!!",{ closeButton: true });  
        },error:function(a){
         
            if(errorCallback){
                errorCallback(a);
                return;
            }
            toastr.error(a.responseJSON.status, i18n.layout.error+'!',{ closeButton: true });
        }
        });
    }

    function ajaxValidationFormSubmit(url,data={},submitId='',successCallback)
    {
        
         var erroCallback=function(json){
            var error='';
            if(json.status == 322) {
                var errors = json.responseJSON;                
                $.each(json.responseJSON.errors, function (key, value) {
                    error+=value+'<br>';
                   
                });   
    
                                      
            }
            if(json.status == 500) {
                error=json.responseText;
                 
            }
            if(json.status == 401) {
                error= i18n.layout.permission_denied;
            }
            toastr.error(error, i18n.layout.error+'!',{ closeButton: true });
                     
        };
        if(!successCallback){
    
            successCallback=function(){
                toastr.success("Updated Successfully!", "Success!!!",{ closeButton: true });
                
            } ;
        }
        ajaxFormSubmit(url,data,'',successCallback,erroCallback);
    }


    function ajaxFormSubmit(url,data={},submitId='',successCallback,errorCallback)
    {
  

        $.ajax({
            url:url,
            type:'POST',
            data:data,
            dataType: 'json',
          
            beforeSend:function(xhr){
            
            $('span.error').html('');
            },
          
            success:function(result){ 
                if(successCallback){
                    successCallback(result);
                    return;
                }           
            },error:function(a){
                    if(errorCallback){
                        errorCallback(a);
                        return;
                    }  
                     else{
                     toastr.error(a.responseJSON.status, i18n.layout.error+'!',{ closeButton: true });   
                    }
            }
        });
    }

    function getAjaxdata(url,successCallback,method='get')
    {
      
        $.ajax({
            url:url,
            type:method,
       
         beforeSend:function(xhr){
            
                 },
        success:function(result){
            if(successCallback){
                successCallback(result);
                return;
            } 
            
            
        },
        error:function(a){
            toastr.error(i18n.layout.please_contact_us_to_report_this_issu, i18n.layout.error+'!',{ closeButton: true });
                      
        }
         });
        return false;
    }


    function confirmAlert(callback='',content=i18n.layout.are_you_sure_you_want_to_continue + '?',title=i18n.layout.confirmation + '!')
    {
       

            /* TODO: Figure out how to translate these buttons */
            /* Following this https://myclabs.github.io/jquery.confirm/ does not work */
                swal({
          title: title,
          text: content,
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: i18n.layout.y_confirm,
          cancelButtonText: i18n.layout.n_confirm,
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {
            callback();
            swal('', i18n.layout.success);
          } else {
        
                swal(i18n.layout.n_confirmed, "cancelled");
                
          }
        });
    }
