    $('.module_select').on('change', '#module_id', function(){
        "use strict";
             $('#module_member_id').empty();
            var module_id = $(this).children("option:selected").val();
            var url= baseUrl+"sales/module_find/"+module_id;
            var callback=function(data){
                $("#module_member_id").select2({
                    data: data,
                     });
            }
            ajaxGetRequest(url,callback);
            $('#module_member_id').append($("<option></option>")
                        .attr("value",'select')
                        .text('Select'));
    });
    $('.module_member').on('change', '#module_member_id', function(){
        "use strict";
        var module_id = $('#module_id').val();     
        var member_id = $(this).children("option:selected").val();
        var url= baseUrl+"sales/module_member/"+module_id+"/"+member_id;
        getAjaxView(url,data=null,'proposal_to_details',false,'get');
    });
    $(document).ready(function() {
        "use strict";
        $(".select2").select2({
            placeholder: i18n.layout.select,
            minimumInputLength: 2,
        });

    });
    $('.date_value').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'YYYY-MM-DD'
        },
             
    });

    $('.submit-estimate').on('click', '#submit_estimate', function(){
        "use strict";
        var form = $('#create-estimate-form');
        var module_id = $('#module_id').val();
        var memberid = $("#module_member_id").val();
        var data={"_token": XCSRFTOKEN,id:"test"};
        
        var successcallback = function(a){
            /*Lang Change*/
             toastr.success(i18n.menu.Estimate+" "+i18n.msg.create_successfully, i18n.layout.success,{ closeButton: true });
            if (module_id == 1) {
                var url= baseUrl+"customer/view/"+memberid;
                getAjaxView(url,data=null,'ajaxview',false,'get');
            }else{
                var url= baseUrl+"leads/view/"+memberid;
                getAjaxView(url,data=null,'ajaxview',false,'get');
            }
        }
        var errorCallback = function(a){
            
        }
          ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback); 
    });